@extends('layouts.layout')


@section('content')

    <div class="row">
        <div class="col-6 offset-3">
            <h3 class="text-center">
                Create Post
            </h3>

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
               </div>

               <div class="form-group">
                   <input class="btn btn-primary" type="submit" value="Create">
               </div>

        </div>
    </div>


@endsection