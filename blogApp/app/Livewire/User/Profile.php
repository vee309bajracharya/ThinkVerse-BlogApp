<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;

class Profile extends Component
{

    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'=>['keep'=>true]];

    public $name, $username, $email, $bio;


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

    public function render()
    {
        return view('livewire.user.profile',[
            'user'=>User::findOrFail(auth()->id())
        ]);
    }
}
