<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Follows {

    public  $user;

    public function __construct($userId)
    {
        $this->user = $userId;
    
    }
    
    public  function allUsers(){

       return User::where('id','!=', $this->user)->get();
    }

    public  function followers(){
   
       return User::with('followers')->find($this->user)->followers;
    }

    public  function followerCount(){

       return User::withCount('followers')->find($this->user)->followers_count;
    }

    public  function notFollowed(){

      return $this->allUsers()->diff($this->following($this->user));
    }

    public  function following(){

        return  User::with('followers')->find($this->user)->followees;
    }

    public  function peopleYouMightKnow(){

      return  $this->notFollowed()->all();
    }

    public  function recentFollowers($numberOfFollowers){

      return  User::with('followers')->latest()->take($numberOfFollowers)->findOrFail($this->user)->followers;
    }

    public  function isFollowedBy($user){

        $this->followers()->first(function($follower) use($user){
            return $follower->id === $user;
        });
    }

}