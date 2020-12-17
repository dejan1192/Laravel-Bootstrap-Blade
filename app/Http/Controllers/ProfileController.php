<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAvatar;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\Follows;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($userId)
    {
      dd($userId);
        
        $user = User::with(['blogPosts', 'comments' => function($query){
            return $query->latest();
        }])->withCount('blogPosts')->findOrFail($userId);
        
        $userFollows = new Follows($userId);

        $followers_count = $userFollows->followerCount();

        $followers =$userFollows->followers();

        $recentFollowers = $userFollows->recentFollowers(3);

        $followed = $userFollows->isFollowedBy(Auth::id());
   
        

       return view('profile.index', compact(['user', 'followers', 'followers_count', 'followed', 'recentFollowers']));
    }

    public function uploadImage(StoreUserAvatar $request)
    {
       
     
        $path = $request->file('profile_image')->store('profile-images');

        $user = User::findOrFail(Auth::id());
        if($user->image){
          
            $user->image->path = $path;
            $user->image->save();
          
        }else{
            $user->image()->save(
                Image::make([
                    'path' => $path
                ])
                );
        }
        $user->save();
        

        return redirect()->back();

        
        
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
