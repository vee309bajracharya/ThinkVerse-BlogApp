<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;

class TopUserInfo extends Component
{
    protected $listeners = [
        'updateTopUserInfo'=> '$refresh'
    ];



    public function render()
    {
        return view('livewire.user.top-user-info',[
            'user'=>User::findOrFail(auth()->id())
        ]);
    }
}
