<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CMail;


class AuthController extends Controller
{
    //loginForm
    public function loginForm(Request $request){
        $data = [
            'pageTitle' => 'Login-ThinkVerse'
        ];
        return view('back.pages.auth.login', $data);
    }

    public function loginHandler(Request $request){

        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // dd($fieldType); 

        // validation
        if($fieldType == 'email'){
            $request->validate(
                [
                    'login_id' => 'required|email|exists:users,email',
                    'password' => 'required|min:8',
                ],
                [
                    'login_id.required'=> 'Enter username or email',
                    'login_id.email'=> 'Invalid Email',
                    'login_id.exists'=> 'No Email found',
                ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:users,username',
                'password'=>'required|min:8',
            ],
            [
                'login_id.required'=> 'Enter username or email',
                'login_id.exists'=> 'No username found'
            ]);
        }

        $creds = array(
            $fieldType=> $request->login_id,
            'password'=>$request->password,
        );
        if(Auth::attempt($creds)){

            //inactive account mode
            if(auth()->user()->status == UserStatus::Inactive){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('user.login')->with('fail', 'Your account is currently inactive');
            }

            //pending mode
            if(auth()->user()->status == UserStatus::Pending){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('user.login')->with('fail', 'Your account is currently pending');
            }

            //redirect to user dashboard
            return redirect()->route('home');

        }else{
            return redirect()->route('user.login')->withInput()->with('fail', 'Incorrect password');
        }

    }
 
    //registerForm
    public function registerForm(Request $request){
        $data = [
            'pageTitle' => 'Register-ThinkVerse'
        ];
        return view('back.pages.auth.register', $data);
    }

    //registerStore
    public function registerStore(Request $request){
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:20',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:10',
                'unique:users,username',
                'regex:/^[a-zA-Z0-9_]+$/'
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'username.regex' => 'Username can only contain letters, numbers, and underscores.',
        ]);
        
        //create and save user
        DB::table('users')->insert([
            'name'=>$request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('user.login')->with('success', 'Registration success ! Please login to continue');
    }

    //forgotForm
    public function forgotForm(Request $request){
        $data = ['pageTitle'=> 'Forgot Password-ThinkVerse'];
        return view('back.pages.auth.forgot', $data);
    }

    //SendPasswordResetLink
    public function SendPasswordResetLink(Request $request){
        //form validation
        $request->validate(
            [
                'email'=> 'required|email|exists:users,email'
            ],[
                'email.required' => 'The :attribute is required',
                'email.email' => 'Invalid Email address',
                'email.exists' => 'No email found',
            ],);

            //get user details
            $user = User::where('email', $request->email)->first();

            //token
            $token = base64_encode(Str::random(64));

            //check existing token
            $oldToken = DB::table('password_reset_tokens')
                            ->where('email', $user->email)
                            ->first();
            
            if($oldToken){
                //update the existing token
                DB::table('password_reset_tokens')
                    ->where('email', $user->email)
                    ->update([
                        'token' =>$token,
                        'created_at'=>Carbon::now()
                    ]);
            }else{
                //new reset pwd token
                DB::table('password_reset_tokens')
                    ->insert([
                        'email'=>$user->email,
                        'token'=>$token,
                        'created_at'=>Carbon::now()
                    ]);
            }

            //clickable action link
            $actionLink = route('user.reset_password_form', ['token'=> $token]);

            $data = array(
                'actionLink' => $actionLink,
                'user'=> $user
            );

            $mail_body = view('email-templates.forgot-template',$data)->render();

            $mailConfig = array(
                'recipient_address'=> $user->email,
                'recipient_name'=> $user->name,
                'subject'=> 'Reset Password',
                'body'=> $mail_body
            );
            if(CMail::send($mailConfig)){
                return redirect()->route('user.forgot')->with('success', 'We have sent an email to reset your password');
            }else{
                return redirect()->route('user.forgot')->with('fail', 'Something went wrong. Link not send');
            }

    }

    //resetForm
    public function resetForm(Request $request, $token=null){

        //if token exists
        $isTokenExists = DB::table('password_reset_tokens')
                            ->where('token', $token)
                            ->first();
        
        if(!$isTokenExists){
            return redirect()->route('user.forgot')->with('fail','Invalid Token. Request another reset password link');
        }else{
            //token expired or not check
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $isTokenExists->created_at)->diffInMinutes(Carbon::now());
            if($diffMins>15){
                //if 15min is over
                return redirect()->route('user.forgot')->with('fail','The password reset link is expired. Please request another link');
            }

            $data = [
                'pageTitle' => 'Reset Password- ThinkVerse',
                'token'=> $token
            ];
            return view('back.pages.auth.reset',$data);
        }

    }

    //resetPasswordHandler
    public function resetPasswordHandler(Request $request){
        //email validation
        $request->validate([
            'new_password' => 'required|min:8|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required'
        ]);

        $dbToken = DB::table('password_reset_tokens')
                        ->where('token', $request->token)
                        ->first();
        
        //get user details
        $user = User::where('email', $dbToken->email)->first();

        //update existing password
        User::where('email', $user->email)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        //send notified email of pwd changed
        $data = array(
            'user'=>$user,
            'new_password'=> $request->new_password
        );
        $mail_body = view('email-templates.password-changes-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name'=> $user->name,
            'subject'=> 'Password Changed',
            'body'=>$mail_body
        );

        if(CMail::send($mailConfig)){
            //delete token from DB after email sent success
            DB::table('password_reset_tokens')->where(
                [
                    'email'=>$dbToken->email,
                    'token'=>$dbToken->token
                ])->delete();
            
            //return to login page
            return redirect()->route('user.login')->with('success', 'Your password has changed successfully. Please login to continue');
        }else{
            //if email isn't sent
            return redirect()->route('user.reset_password_form')->with('fail', 'Something went wrong. Try again');
        }
    }


}
