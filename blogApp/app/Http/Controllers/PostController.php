<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //add_post
    public function addPost(Request $request){
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children')->orderBy('name','asc')->get();
        $categories = Category::where('parent',0)->orderBy('name','asc')->get();

        if(count($pcategories)>0){
            foreach($pcategories as $item){
                $categories_html.='<optgroup label="'.$item->name.'">';
                foreach($item->children as $category){
                    $categories_html.='<option value="'.$category->id.'">'.$category->name.'</option>';
                }
                $categories_html.='</optgroup>';
            }
        }

        if(count($categories)>0){
            foreach($categories as $item){
                $categories_html.= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }
        $data = [
            'pageTitle'=> 'Add New Post', 
            'categories_html'=> $categories_html
        ];
        return view('back.pages.user.add_post', $data);
  
    }

    //create post
    public function createPost(Request $request){
        $request->validate([
            'title'=> 'required|unique:posts,title',
            'content'=>'required',
            'category'=>'required|exists:categories,id',
            'featured_image'=> 'required|mimes:png,jpg,jpeg|max:1024'
        ]);

        if($request->hasFile('featured_image')){
            $path = "images/posts/";
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time().'_'.$filename;

            //upload img
            $upload = $file->move(public_path($path),$new_filename);

            if($upload){
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category = $request->category;
                $post->title = $request->title;
                $post->content = $request->content;
                $post->featured_image = $new_filename;
                $post->tags = $request->tags;
                $post->meta_keywords = $request->meta_keywords;
                $post->meta_description = $request->meta_description;
                $post->visibility = $request->visibility;
                $saved = $post->save();

                if($saved){
                    return response()->json(['status'=>1, 'message'=> 'New Post created']);
                }else{
                    return response()->json(['status'=>0, 'message'=> 'Something went wrong']);

                }
            }else{
                return response()->json(['status'=>0, 'message'=> 'Error in uploading image']);
            }
        }

    }

    //list posts
    public function allPosts(Request $request){
        $data = ['pageTitle'=> 'Posts'];
        return view('back.pages.user.posts',$data);
    }

    //editPosts
    public function editPost(Request $request, $id=null){
        $post = Post::findOrFail($id);
        $categories_html = '';
        $pcategories = ParentCategory::whereHas('children')->orderBy('name','asc')->get();
        $categories = Category::where('parent',0)->orderBy('name','asc')->get();
        if(count($pcategories)>0){
            foreach($pcategories as $item){
                $categories_html.='<optgroup label="'.$item->name.'">';
                    foreach($item->children as $category){
                        $selected = $category->id == $post->category ? 'selected' : '';
                        $categories_html.='<option value="'.$category->id.'"
                        '.$selected.'>'.$category->name.'</option>';
                    }
                $categories_html.='</optgroup>';
            }
        }

        if(count($categories)>0){
            foreach($categories as $item){
                $selected = $item->id == $post->category ? 'selected':'';
                $categories_html.= '<option value="'.$item->id.'"'.$selected.'>'.$item->name.'</option>';
            }
        }

        $data = [
            'pageTitle'=> 'Edit',
            'post'=>$post,
            'categories_html'=>$categories_html
        ];
        return view('back.pages.user.edit_post',$data);
    } 

    //updatePost
    public function updatePost(Request $request){
        $post = Post::findOrFail($request->post_id);
        $featured_image_name = $post->featured_image;

        //form validate
        $request->validate([
            'title'=>'required|unique:posts,title,'.$post->id,
            'content'=>'required',
            'category'=>'required|exists:categories,id',
            'featured_image'=>'nullable|mimes:jpeg,jpg,png|max:1024'
        ]);

        if($request->hasFile('featured_image')){
            $old_featured_image = $post->featured_image;
            $path = 'images/posts/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time().'_'.$filename;

            //new featured image
            $upload = $file->move(public_path($path),$new_filename);
            if($upload){
                $featured_image_name = $new_filename;
            }else{
             session()->flash('error', 'Failed to update the image.');
            }

        }
        //update post in db
        $post->author_id = auth()->id();
        $post->category = $request->category;
        $post->title = $request->title;
        $post->slug = null;
        $post->content = $request->content;
        $post->featured_image = $featured_image_name;
        $post->tags = $request->tags;
        $post->meta_keywords = $request->meta_keywords;
        $post->meta_description = $request->meta_description;
        $post->visibility = $request->visibility;
        $saved = $post->save();
        if ($saved) {
            session()->flash('success', 'Post updated successfully!');
        } else {
            session()->flash('error', 'Failed to update the post.');
        }
    }

}
