<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //admin dashboard
    public function adminDashboard(Request $request){
        $data = [
            'adminPageTitle'=> 'Admin Dashboard'
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
