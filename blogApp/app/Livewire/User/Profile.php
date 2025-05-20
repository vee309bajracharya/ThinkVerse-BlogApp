<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\CMail;

class Profile extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];

    public $name, $username, $email, $bio; //personal details
    public $current_password, $new_password, $new_password_confirmation; //password form


    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;

        $user = User::findOrFail(auth()->id());
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;
    }

    //updatepersonalDetails()
    public function updatePersonalDetails(){
        $user = User::findOrFail(auth()->id());

        $this->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:20',
                'regex:/^[a-zA-Z\s]+$/'
            ],            
            'username'=> 'required|unique:users,username,'.$user->id,
            'email'=> 'required|email|unique:users,email,'.$user->id,
        ]);

        //user info update
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->bio = $this->bio;
        $updated = $user->save();

        sleep(0.5);

        if($updated){
            $this->dispatch('showToast', ['type'=>'success', 'message'=> 'Your personal details have updated successfully']);
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        }else{
            $this->dispatch('showToast',['type'=>'error', 'message'=> 'Something went wrong']);
        }
    }

    //updatePassword()
    public function updatePassword(){
        $user = User::findOrFail(auth()->id());

        //form validation
        $this->validate([
            'current_password'=>[
                'required','min:8',
                function($attribute,$value,$fail) use($user){
                    if(!Hash::check($value, $user->password)){
                        return $fail(__('Current password does not match the records'));
                    }
                }
            ],
            'new_password'=>'required|min:8|confirmed',            
        ]);

        //user password update
        $updated = $user->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if($updated){
            //send email notification of password changed
            $data = array(
                'user'=>$user,
                'new_password'=>$this->new_password
            );

            $mail_body = view('email-templates.password-changes-template', $data)->render();

            $mail_config = array(
                'recipient_address'=>$user->email,
                'recipient_name'=>$user->name,
                'subject'=>'Password Changed',
                'body'=>$mail_body
            );

            CMail::send($mail_config);

            //logout and render to login
            auth()->logout();
            Session::flash('info', 'Your password has been changed successfully. Please login with new password');
            $this->redirectRoute('user.login');

        }else{
            $this->dispatch('showToast', ['type'=>'error', 'message'=>'Something went wrong']);
        }


    }

    public function render()
    {
        return view('livewire.user.profile',[
            'user'=>User::findOrFail(auth()->id())
        ]);
    }
}
