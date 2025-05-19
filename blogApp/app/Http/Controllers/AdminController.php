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



}
