<?php

namespace App\Livewire\User;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\File;

class Posts extends Component
{
    use WithPagination;

    public $perPage = 3;
    public $categories_html;

    public $search = null;
    public $author = null;
    public $category = null;
    public $visibility = null;
    public $sortBy = 'asc';
    public $post_visibility;

    //to show search on URL bar as well
    protected $queryString = [
        'search'=> ['except'=>''],
        'author'=> ['except'=>''],
        'category'=> ['except'=>''],
        'visibility'=> ['except'=>''],
        'sortBy'=> ['except'=>''],
    ];
    
    //resets the page, if search value is updated
    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedAuthor(){
        $this->resetPage();
    }

    public function updatedCategory(){
        $this->resetPage();
    }

    public function updatedVisibility(){
        $this->resetPage();
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);

        // Delete the featured image file if it exists
        $imagePath = public_path('images/posts/' . $post->featured_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $deleted = $post->delete();

        if ($deleted) {
            session()->flash('success', 'Post deleted successfully!');
        } else {
            session()->flash('error', 'Failed to delete the post.');
        }
        $this->resetPage();
    }

    public function mount(){
        $this->post_visibility = $this->visibility == 'public' ? 1 : 0;
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children',function($q){
            $q->whereHas('posts');
        })->orderBy('name','asc')->get();

        $categories = Category::whereHas('posts')->where('parent',0)->orderBy('name','asc')->get();

        if(count($pcategories)>0){
            foreach($pcategories as $item){
                $categories_html.='<optgroup label=" '.$item->name.' ">';
                    foreach($item->children as $category){
                        if($category->posts->count()>0){
                            $categories_html.= '<option value=" '.$category->id.' ">'.$category->name.'</option>';
                        }
                    }
                $categories_html.='</optgroup>';
            }
        }

        if(count($categories)>0){
            foreach($categories as $item){
                $categories_html.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }

        $this->categories_html = $categories_html;
    }


    public function render()
    {
        return view('livewire.user.posts',[
            'posts'=>auth()->user()->type=="admin" ? 

            Post::search(trim($this->search))
            ->when($this->author,function($query){
                $query->where('author_id',$this->author);
            })
            ->when($this->category, function($query){
                $query->where('category',$this->category);
            })
            ->when($this->visibility,function($query){
                $query->where('visibility', $this->post_visibility);
            })
            ->when($this->sortBy,function($query){
                $query->orderBy('id', $this->sortBy);
            })
            ->paginate(trim($this->perPage)) : 

            
            Post::search(trim($this->search))
            ->when($this->author,function($query){
                $query->where('author_id',$this->author);
            })
            ->when($this->category, function($query){
                $query->where('category',$this->category);
            })
            ->when($this->visibility, function($query){
                $query->where('visibility',$this->post_visibility);
            })
            ->when($this->sortBy,function($query){
                $query->orderBy('id', $this->sortBy);
            })
            ->where('author_id',auth()->id())->paginate($this->perPage)
        ]);
    }
}
