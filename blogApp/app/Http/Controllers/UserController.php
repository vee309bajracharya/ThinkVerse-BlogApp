<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;



class UserController extends Controller
{
        //users dashboard
        public function userDashboard(Request $request){

            $userId = auth()->id();

            $totalPosts = Post::where('author_id',$userId)->count();

            $publishedPosts = Post::where('author_id',$userId)
                                    ->where('visibility', 1)
                                    ->count();

            $privatePosts = Post::where('author_id',$userId)
                                    ->where('visibility', 0)
                                    ->count(); 

            $recentPosts = Post::where('author_id',$userId)
                                ->latest()
                                ->take(3)
                                ->get();

            $data = [
                'pageTitle'=> 'User Dashboard',
                'totalPosts'=>$totalPosts,
                'publishedPosts'=>$publishedPosts,
                'privatePosts'=>$privatePosts,
                'recentPosts'=>$recentPosts
            ];
            return view('back.pages.user.dashboard', $data);
        }

        //user logout
        public function logoutHandler(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            if(isset($request->source) && $request->source == 'front'){
                // Redirect to guest entry page after logout from front-end
                return redirect()->route('home')->with('success', 'Logged out successfully');
            }
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
