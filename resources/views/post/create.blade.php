@extends('layouts.layout')


@section('content')
    <a href="{{ route('users.show', Auth::user()->id) }}"><i class="far fa-hand-point-left"></i> Back to profile</a>
    <div class="row">
        <div class="col-6 offset-3">
            <h3 class="text-center">
                Create Post
            </h3>
        @if ($errors->any())
       
       
        @endif
        <form enctype="multipart/form-data" action="{{route('posts.store')}}" method="POST">
            @csrf
               <div class="form-group">
               <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Post Title">
             
                @error('title')
                <div class="invalid-feedback">
                    Please provide a valid title
                  </div>
                @enderror
               </div>

               <div class="form-group">
                   <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Write Something.."></textarea>
                   @error('content')
                   <div class="invalid-feedback">
                       Content is required
                     </div>
                   @enderror
               </div>

               <div class="form-group">
                <input class="form-control" type="file" name="image" id="image">
                @error('image')
                    {{ $errors->first('image') }}
                @enderror
               </div>

               <div class="form-group">
                   
                   <button type="submit" class="btn btn-primary">Create</button>
               </div>

        </div>

        <div class="col-3">
            <h5 class="text-center">Available tags</h5>
            @if ($tags->count() > 0)
             
              @foreach ($tags as $tag)
              
                  <div >
                    <input type="checkbox" name="tags[]" id="tag-{{ $tag->name }}" value="{{ $tag->id }}">
                    <label for="tag-{{ $tag->name }}">{{ $tag->name }}</label>
                  </div>
             
              @endforeach
            @else
                <p class="text-center">No tags available...</p>
            @endif

       
            
            <a href="{{ route('tags.create') }}"><i class="fas fa-tags"></i>Create new tag</a>
            
        </div>
    </div>


@endsection