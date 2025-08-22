<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class BlogController extends Controller
{
    public function index(Request $request){
        $data = [
            'pageTitle'=> 'ThinkVerse | Home'
        ];
        return view('front.pages.index', $data);
    }

    public function categoryPosts(Request $request, $slug=null){
        $category = Category::where('slug',$slug)->firstOrFail();
        $posts = Post::where('category',$category->id)->paginate(8);
        $title = 'Posts in Category: ' . $category->name;
        $description = 'Browse latest posts in '. $category->name.'category. Stay updated';

        $data = [
            'pageTitle' => $category->name,
            'posts' => $posts,
        ];
        return view('front.pages.category_posts', $data);
    }

    public function authorPosts(Request $request, $username=null){
        $author = User::where('username',$username)->firstOrFail(); //find user on the basis of username
        $posts = Post::where('author_id',$author->id)->orderBy('created_at','asc')->paginate(8);
        $title = $author->name.'- Blog Posts';
        $description = 'Browse latest posts by '. $author->name.'. Stay updated';
        $data=[
            'pageTitle'=>$author->name,
            'author'=>$author,
            'posts'=>$posts,
        ];
        return view('front.pages.author_posts', $data);

    }
    
    public function tagPosts(Request $request, $tag=null){
        $posts = Post::where('tags','LIKE',"%{$tag}%")->where('visibility',1)->paginate(8);

        $data=[
            'pageTitle' => $tag,
            'posts' => $posts,
        ];
        return view('front.pages.tag_posts', $data);
    }

    public function searchPosts(Request $request){
        $query = $request->input('query');
        if($query){
            $keywords = explode(' ', $query);
            $postsQuery = Post::query();
            foreach($keywords as $keyword){
                $postsQuery->orWhere('title','LIKE',"%".$keyword."%");
            }
            $posts = $postsQuery->where('visibility',1)
                                ->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $posts = collect();
        }

        $data=[
            'pageTitle' => 'Search Results for: ' . $query,
            'posts' => $posts,
            'query' => $query,
        ];
        return view('front.pages.search_posts', $data);

    }

    public function readPost(Request $request, $slug = null){
        // === Fetch the Post by Slug ===
        $post = Post::where('slug', $slug)->firstOrFail();
    
        // === Store Viewed Post ID into Cookie for Greedy Tracking ===
        $viewedPostIds = json_decode($request->cookie('viewed_posts', '[]'), true);
        $viewedPostIds = is_array($viewedPostIds) ? $viewedPostIds : [];
        array_unshift($viewedPostIds, $post->id); // Push current post to front
        $viewedPostIds = array_unique($viewedPostIds); // Remove duplicates
        $viewedPostIds = array_slice($viewedPostIds, 0, 10); // Keep latest 10 only
    
        // === Content-Based Filtering (Tags + Title Keywords) ===
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('visibility', 1)
            ->where(function ($query) use ($post) {
                // Match by tags
                $tags = array_map('trim', explode(',', $post->tags));
                foreach ($tags as $tag) {
                    $query->orWhere('tags', 'LIKE', "%$tag%");
                }
    
                // Match by title words
                $keywords = array_filter(explode(' ', $post->title));
                foreach ($keywords as $word) {
                    $query->orWhere('title', 'LIKE', "%$word%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
    
        
        // === Greedy Recommendation via Cookie Tracking (if no content-based match) ===
        if ($relatedPosts->isEmpty() && !empty($viewedPostIds)) {
            $relatedPosts = Post::whereIn('id', $viewedPostIds)
                ->where('id', '!=', $post->id)
                ->where('visibility', 1)
                ->orderByRaw("FIELD(id, " . implode(',', $viewedPostIds) . ")")
                ->take(6)
                ->get();
        }
    
        // // === Final Fallback (Recent Visible Posts) ===
        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::where('id', '!=', $post->id)
                ->where('visibility', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        }
    
        // === Fetch Next/Previous Post ===
        $nextPost = Post::where('id', '>', $post->id)
            ->where('visibility', 1)
            ->orderBy('id', 'asc')
            ->first();
    
        $prevPost = Post::where('id', '<', $post->id)
            ->where('visibility', 1)
            ->orderBy('id', 'desc')
            ->first();
    
        // === Prepare Data for View ===
        $data = [
            'pageTitle' => $post->title,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'nextPost' => $nextPost,
            'prevPost' => $prevPost,
        ];
    
        // === Return View and Set Updated Cookie ===
        return response()
            ->view('front.pages.single_post', $data)
            ->cookie('viewed_posts', json_encode($viewedPostIds), 60 * 24 * 7); // 7 days
    }
    
    
}
