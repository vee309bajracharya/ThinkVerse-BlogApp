<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    //admin login
    public function loginForm(){
        return view('back.pages.admin.admin-login');
    }

    //adminLogin logic handler
    public function loginHandler(Request $request){
        $validator = Validator::make($request->all(),[
            'login_id'=> 'required|string',
            'password'=> 'required|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $login_id = $request->login_id;
        $password = $request->password;

        $admin = Admin::where('email', $login_id)
                        ->orWhere('username', $login_id)
                        ->first();
        
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::guard('admin')->login($admin, $request->filled('remember'));
                
                return redirect()->route('admin.admin-dashboard')->with('success', 'Welcome back, Admin!');
        }
                
        return redirect()->back()->with('error', 'Invalid login credentials')->withInput();
    }
}
