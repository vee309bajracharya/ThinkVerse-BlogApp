<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $perPage = 3;

    
    public function render()
    {
        return view('livewire.user.posts',[
            'posts'=>auth()->user()->type=="admin" ? 
            Post::paginate($this->perPage) : 
            Post::where('author_id',auth()->id())->paginate($this->perPage)
        ]);
    }
}
