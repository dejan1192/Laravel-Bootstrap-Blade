<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($userId)
    {
      
        
        $user = User::with(['blogPosts', 'comments'])->withCount('blogPosts')->findOrFail($userId);
        
        $followers_count = User::withCount('followers')->find($userId)->followers_count;

        $followers = User::with('followers')->find($userId)->followers;

        $recentFollowers = User::with('followers')->latest()->take(3)->findOrFail($userId)->followers;
   
       
        $followed = $followers->first(function($follower){
            return $follower->id === Auth::id();
        });
   
        

       return view('profile.index', compact(['user', 'followers', 'followers_count', 'followed', 'recentFollowers']));
    }

    public function uploadImage(Request $request)
    {
       
        $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('profile_image')->getClientOriginalExtension();
        $newFileName = 'profile_'.$filename.time().'.'.$extension;
        $request->file('profile_image')->storeAs('public/profile-images', $newFileName);

        $user = User::findOrFail(Auth::id());
        $user->profile_image = $newFileName;
        $user->save();

        return redirect()->route('profile.index', $user->id);

        
        
    }

    public function follow(Request $request)
    {   
        $followedUserId = (int)$request->input('user_id');
     
        Gate::authorize('follow', $followedUserId);
        
        $user = User::findOrFail(Auth::id());
        $user->followees()->syncWithoutDetaching($followedUserId);

        return redirect()->route('profile.index', $followedUserId);
    }

   
 
}
