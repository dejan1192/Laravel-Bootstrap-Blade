@extends('layouts/layout')


@section('content')


   <div class="card p-4 mb-3">
      <div class="row">
         <div class="col-1">
            <a class="btn btn-outline-primary" href="{{route('index')}}">Back</a>
         </div>
        <div class="col-11 text-left">
         <h2 class='card-title  mb-3'>{{$post->title}}</h2>
        </div>
      </div>
      <img class="card-img-top" src="{{asset('storage/post-images/'.$post->image)}}" alt="image">
    <p class="card-text mb-5">{{$post->content}}</p>
 <div class="row">

 <p class="text-muted font-weight-bold col-3">by <a href='{{route('profile.index', $post->user->id)}}'> {{$post->user->name}}</a>
   </p>
   <p class="text-muted col-3 offset-6 text-right">Created {{$post->created_at->diffForHumans()}}</p>
   
 </div>
   </div>

   @if($errors->any())
        @foreach($errors->all() as $error)
          <x-package-alert type='danger' :msg="$error" />
        @endforeach
   @endif
  <section>
   <h4 class="text-center text-muted">Comments</h4>
   <form action="{{route('comments.store')}}" method="post">

      @csrf
   <input type="hidden" name="post_id" value="{{$post->id}}">
      <div class="form-group">
       <div class="form-group">
         <textarea type="text" name="content" id="content" class="form-control" placeholder="Write something.."></textarea>
       </div>
         <input type="submit" class="btn btn-primary" value="comment">
      </div>

   </form>

   @foreach($post->comments as $comment)
     <div class="card p-2 mb-2">
        <div class="row">
        <div class="col-2 font-weight-bold text-{{Auth::user()->id ===$comment->user->id ? 'success' : 'primary'}}">
        <a href="{{route('profile.index', $comment->user->id)}}">{{$comment->user->name}}</a>
           </div>
           <div class="col-3 offset-7 text-muted text-right">
              commented {{$comment->created_at->diffForHumans()}}
           </div>
        </div>

        <div class="row">
           <div class="col-2">
               @if($comment->user->profile_image)
               <img width='50px' class="rounded-circle" src="{{asset('storage/profile-images/' . $comment->user->profile_image)}}" alt="profile">
               @endif
           </div>
           <div class="col-10 card-text">
              {{$comment->content}}
           </div>
        </div>
     </div>

   @endforeach
 
</section>


@endsection