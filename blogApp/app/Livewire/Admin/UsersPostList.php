<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\ParentCategory;

class UsersPostList extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = null;
    public $author = null;
    public $category = null;
    public $visibility = null;
    public $sortBy = 'asc';
    public $post_visibility;
    public $categories_html;
    
    protected $queryString = [
        'search'=> ['except'=>''],
        'author'=> ['except'=>''],
        'category'=> ['except'=>''],
        'visibility'=> ['except'=>''],
        'sortBy'=> ['except'=>''],
    ];

    public function updatedSearch(){ $this->resetPage(); }
    public function updatedAuthor(){ $this->resetPage(); }
    public function updatedCategory(){ $this->resetPage(); }
    public function updatedVisibility(){
        $this->resetPage();
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function mount(){
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;

        // generate reusable HTML options
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children', function($q) {
            $q->whereHas('posts');
        })->orderBy('name','asc')->get();

        $categories = Category::whereHas('posts')->where('parent', 0)->orderBy('name','asc')->get();

        foreach ($pcategories as $item) {
            $categories_html .= '<optgroup label="'.$item->name.'">';
            foreach ($item->children as $child) {
                if ($child->posts->count() > 0) {
                    $categories_html .= '<option value="'.$child->id.'">'.$child->name.'</option>';
                }
            }
            $categories_html .= '</optgroup>';
        }

        foreach ($categories as $item) {
            $categories_html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }

        $this->categories_html = $categories_html;
    }

    public function render()
    {
        return view('livewire.admin.users-post-list', [
            'posts' => Post::search(trim($this->search))
                ->when($this->author, fn($q) => $q->where('author_id', $this->author))
                ->when($this->category, fn($q) => $q->where('category', $this->category))
                ->when($this->visibility, fn($q) => $q->where('visibility', $this->post_visibility))
                ->when($this->sortBy, fn($q) => $q->orderBy('id', $this->sortBy))
                ->paginate(trim($this->perPage)),
            'authors' => User::whereHas('posts')->get()
        ]);
    }
}
