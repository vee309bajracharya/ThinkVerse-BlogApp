<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    public $list = 3;

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $baseQuery = User::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%');
    
        // Clone the base query for count before pagination affects it
        $totalUsers = (clone $baseQuery)->count();
    
        $usersList = $baseQuery->orderBy('created_at', 'asc')
                               ->paginate($this->list);
    
        return view('livewire.admin.users-list', [
            'usersList' => $usersList,
            'totalUsers' => $totalUsers,
        ]);
    }
    
    
}
