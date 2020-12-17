<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Follows;
use Illuminate\Support\Facades\Gate;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user){

       
          
        $user = User::with(['blogPosts', 'comments' => function($query){
            return $query->latest();
        }])->withCount('blogPosts')->findOrFail($user->id);
        
        $userFollows = new Follows($user->id);
      
        $followers_count = $userFollows->followerCount();

        
        

        $followers =$userFollows->followers();

        $recentFollowers = $userFollows->recentFollowers(3);

        $followed = $userFollows->isFollowedBy(Auth::id());

        return view('users.show', compact(['user', 'followers', 'followers_count', 'followed', 'recentFollowers']));
    }

    public function edit(User $user){

        // $this->authorize('update');
       Gate::authorize('update', $user);
        
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user){

        Gate::authorize('update', $user);

        

        if($request->file('profile_image')){
            $path = $request->file('profile_image')->store('profile_images');

            if($user->image) {
                  
                Storage::delete($user->image->path);
                $user->image->path = $path;
              
             
                // dd($user->image->path);
                $user->image->save();

               
            }else{
                $user->image()->save(
                    Image::make([
                        'path' => $path
                    ])
                );
                
            }
        
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return back();
        
    }

    public function follow(Request $request ){

        $followedUserId = (int)$request->input('user_id');
     
        Gate::authorize('follow', $followedUserId);
        
        $user = User::findOrFail(Auth::id());
        $user->followees()->syncWithoutDetaching($followedUserId);

        return redirect()->route('users.show', $followedUserId);
    }

    
}
