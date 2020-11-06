@extends('layouts.layout')



@section('content')

<div class="card p-3">
    <div class="row">
        
       
    </div>
    <div class="row ">
        <div class="col-3">
        <img class="img-thumbnail rounded" src="{{asset('storage/profile-images/'. $user->profile_image)}}" alt="profile-image">
     
        </div>
        <div class="col-3">
          <h4>{{$user->name}}</h4>
          
      
    @can('follow', $user->id)
        @if(!$followed)

        <button onclick="event.preventDefault();document.getElementById('follow-form').submit()" class="btn text-white btn-info">
        Follow
    </button>

        @else
        <button type="button" class="btn  btn-success" disabled>Following</button>
        @endif
    @endcan


        <form action="{{route('profile.follow')}}" id="follow-form" method='POST' class="d-none">
            @csrf
            <input type="hidden" name="user_id" value='{{$user->id}}'>
        </form>
        </div>
        <div class="col-3 text-center">
            <p> Number Of Posts</p>
            <p class="font-weight-bold">{{$user->blog_posts_count}}</p>
        </div>
    
        <div class="col-3 text-center">
          <p>  Number Of Followers</p>
        <p class="font-weight-bold">
         
            <a href='#' class="btn btn-info text-white" data-toggle="modal" data-target="#followersModal">
                {{$followers_count}}
            </a>
        </p>
        </div>
    </div>
</div>

<div class="p-2 ">
   @if(Auth::id() === $user->id)
     <button onclick="document.getElementById('profile_image').click()" class="btn btn-info text-white">Upload Profile Image</button>
   @endif

<form class='d-none' id='profile-upload' action="{{route('profile.upload')}}" enctype="multipart/form-data" method="post">
    @csrf
        <input 
        onchange="document.getElementById('profile-upload').submit()"
        type="file" 
        name="profile_image" 
        id="profile_image">
    </form>
</div>

<div class="row">

   <div class="col-6 p-3">
    @if($user->blogPosts->count() > 0)

        @foreach($user->blogPosts as $post)
            <div class="card p-3 mb-2">
                <h5 class="card-title">
                <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                </h5>
                <div class="card-text">
                    {{$post->content}}
                </div>
            </div>
        @endforeach

    @else 
        <h2>No posts..</h2>
    @endif
   </div>
   <div class="col-4 offset-2">
       <h4>Recent Followers</h4>
        @if($recentFollowers->count() > 0)
            @foreach($recentFollowers as $follower)
                <li><a href="{{route('profile.index', $follower->id)}}">{{$follower->name}}</a></li>
            @endforeach
        @endif
   </div>

</div>

  
  <!-- Modal -->
  <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content p-2">
        
          <h5 class="modal-title text-center" >Followers</h5>
         
      
        <div class="modal-body">
            @if($followers->count() > 0)
               <ul class="list-group">
                @foreach($followers as $follower)
                <li class="list-group-item">
                    <a href="{{route('profile.index', $follower->id)}}">
                        {{$follower->name}}
                    </a>
                </li>
            @endforeach
               </ul>
            @else
               <h5>No followers..</h5>
        
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   
        </div>
      </div>
    </div>
  </div>

@endsection