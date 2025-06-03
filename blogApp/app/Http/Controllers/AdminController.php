<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //admin dashboard
    public function adminDashboard(Request $request){
        $data = [
            'pageTitle'=> 'Admin Dashboard'
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
        $data= ['pageTitle'=> 'Manage Categories'];
        return view('back.pages.admin.categories_page', $data);
    }

    //all users list
    public function usersList(Request $request){
        $data = [
            'pageTitle'=> 'Users List'
        ];
        return view('back.pages.admin.users-list',$data);
    }



}
