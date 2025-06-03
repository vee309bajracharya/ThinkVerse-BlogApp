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
            return view('back.pages.user.profile', $data);
        }

        public function editProfile(Request $request){
            $data=['pageTitle'=>'Edit Profile'];
            return view('back.pages.user.edit_profile');
        }
        
        //user profile update
        public function updateProfile(Request $request){
            $user = auth()->user();
        
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
                // Delete old image if exists
                $oldImage = public_path('images/users' . $user->picture);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
        
                // Move new image
                $file->move(public_path('images/users'), $filename);
        
                // Save new image filename
                $user->picture = $filename;
            }
        
            $user->save();
        
            return response()->json([
                'status' => 1,
                'message' => 'Profile updated successfully',
            ]);
        }
        
}
