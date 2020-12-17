@extends('layouts.layout')
 

@section('content')
     
    

 <div class="row">
   <div class="col-9">
    <div class="card p-1 mb-3">
      <div class="row">
        <h4 class="text-muted col-12 text-center">People You Might Know</h4>
      @if(count($peopleYouMightKnow)> 0)
       
        @foreach($peopleYouMightKnow as $person)
       
        <a class="col-2" href="{{route('users.show', $person->id)}}">
              <div >
                <img src="{{'storage/profile-images/'.$person->profile_image}}" alt="profile" class="img-thumbnail">
                  <h6 class="font-weight-bold text-center">{{$person->name}}</h6>
                </div>
            </a>
          @endforeach

        @else
            <p class="col-12 text-center text-muted ">No suggestions..</p>

      @endif
       
      </div>
     
    </div>
    @foreach($posts as $post)
    <div class="card p-2 mb-3">
      {{-- {{$post->tags}} --}}
      <x-tags :tags="$post->tags"/>
  
       <div class="row">
         <div class="col-1">
   
        
        <a href="{{route('users.show', $post->user->id)}}">
          <img   class="img-fluid rounded mb-2" src="{{$post->user->image->url()}}"  alt="profile">
        </a>
   
        
         </div>
         <div class="col-9 text-center">
        <h3 class="card-title">
        <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
        </h3>
         </div>
         <div class="col-2">
           {{$post->created_at->diffForHumans()}}
         </div>
       </div>
     
     
        @if ($post->image)
         <img class="card-img-top" src="{{$post->image->url()}}" alt="image">
        @endif
      
     
        <p class="card-text">{{$post->content}}</p>
      <p><a href="{{route('users.show', $post->user->id)}}">
        Posted by <span class="font-weight-bold">{{$post->user->name}}</span>
      </a></p>
        <p class="text-muted">{{$post->comments_count}} {{$post->comments_count === 1 ? 'person commented' : 'people commented'}}</p>
        <a href="{{route('posts.show', $post->id)}}" class="card-link">Read more...</a>
    </div>
  @endforeach

   </div>
   <div class="col-3">
     @include('post._createLink')
      @if($recentPosts)
        <h4 class="text-center">Recent Posts</h4>
     <div class="list-group">
      @foreach($recentPosts as $post)
     
        <a class="card" href="{{route('posts.show', $post->id)}}">
         <div class="row">
          <div class="col-4">
            <img class="img-fluid" src="{{ $post->image->url() }}" alt="asd" >
          </div>
          <div class="col-8">
            <p>{{$post->title}}</p>
            <p class="text-muted"> By {{$post->user->name}}</p>
          </div>
         </div>
        </a>
     
           @endforeach
     </div>
      @empty($recentPosts)
          <h4>No Posts</h4>
      @endempty

      @endif

      <br>
      <div class="card p-2">
        <h4 class="text-center">Following</h4>
      @foreach ($following as $person)
          <div class="col-6">
              <img class="img-fluid" src="{{ $person->image->url() }}" alt="img">
              <p class="text-center">{{ $person->name }}</p>
          </div>
      @endforeach
      </div>
   </div>
 </div>

@endsection