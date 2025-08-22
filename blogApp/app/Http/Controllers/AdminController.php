<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Post;
use App\Models\ParentCategory;
use App\Models\Category;
use Carbon\Carbon;

class AdminController extends Controller
{
    //admin dashboard
    public function adminDashboard(Request $request){

        $totalUsers = User::count();
        $totalPosts = Post::count();
        $publishedPosts = Post::where('visibility', 1)->count();
        $totalParentCategories = ParentCategory::count();
        $totalCategories = Category::whereNotNull('parent')->count();

        $recentPosts = Post::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        $postsPerMonth = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

        $data = [
            'adminPageTitle'=> 'Admin Dashboard',
            'totalUsers'=>$totalUsers,
            'totalPosts'=>$totalPosts,
            'publishedPosts'=>$publishedPosts,
            'totalParentCategories'=>$totalParentCategories,
            'totalCategories'=>$totalCategories,
            'recentPosts' => $recentPosts,
            'recentUsers' => $recentUsers,
            'postsPerMonth' => array_values($postsPerMonth),
            'months' => array_map(function($m) {
                return Carbon::create()->month($m)->format('M');
            }, array_keys($postsPerMonth))
        ];
        return view('back.pages.admin.admin-dashboard', $data);
    }

    public function logoutHandler()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    //categories
    public function categoriesPage(Request $request){
        $data= ['adminPageTitle'=> 'Manage Categories'];
        return view('back.pages.admin.categories_page', $data);
    }

    //all users list
    public function usersList(Request $request){
        $data = [
            'adminPageTitle'=> 'Users List'
        ];
        return view('back.pages.admin.users-list',$data);
    }

    //users posts
    public function usersPosts(Request $request){
        $data=['adminPageTitle'=> 'Users Posts List'];
        return view('back.pages.admin.users-posts');
    }



}
