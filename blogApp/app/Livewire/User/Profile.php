<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Helpers\CMail;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\UserSocialLink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Profile extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];

    public $name, $username, $email, $bio; //personal details
    public $current_password, $new_password, $new_password_confirmation; //password form
    public $fb_url, $insta_url, $github_url; //updateSocialLink()

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;

        $user = User::with('social_links')->findOrFail(auth()->id());
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;

        if(!is_null($user->social_links)){
            $this->fb_url = $user->social_links->fb_url;
            $this->insta_url = $user->social_links->insta_url;
            $this->github_url = $user->social_links->github_url;
        }
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
                        return $fail(('Current password does not match the records'));
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

    //updateSocialLink()
    public function updateSocialLinks(){
        $this->validate([
            'fb_url'=>'nullable|url',
            'insta_url'=>'nullable|url',
            'github_url'=>'nullable|url',
        ]);

        $user = User::findOrFail(auth()->id());
        //fetch the url
        $data = array(
            'fb_url'=>$this->fb_url,
            'insta_url'=>$this->insta_url,
            'github_url'=>$this->github_url,
        );

        if(!is_null($user->social_links)){
            $query = $user->social_links()->update($data);
        }else{
            $data['user_id'] = $user->id;
            $query = UserSocialLink::insert($data);
        }

        if($query){
            $this->dispatch('showToast', ['type'=> 'success', 'message'=>'social links have updated']);
        }else{
            $this->dispatch('showToast', ['type'=> 'error', 'message'=>'Something went wrong']);

        }

    }

    public function render()
    {
        return view('livewire.user.profile',[
            'user'=>User::findOrFail(auth()->id())
        ]);
    }
}
