<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class UserController extends Controller
{
        //user's dashboard
        public function userDashboard(Request $request){
            $data = [
                'pageTitle'=> 'User Dashboard'
            ];
            return view('back.pages.user.dashboard', $data);
        }

        //user logout
        public function logoutHandler(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('user.login')->with('fail','Logged out successfully');
        }

        //user profile
        public function profileView(Request $request){
            $data = ['pageTitle'=> 'User Profile'];
            return view('back.pages.profile', $data);
        }
}
