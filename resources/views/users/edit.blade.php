@extends('layouts.layout')


@section('content')
    
    <div class="col-8">
        <a href="{{ route('users.show', $user) }}">Back to profile</a>
                <h2 class="text-center">User Edit</h2>
      

        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @method("PUT")
            @csrf 

            <div class="p-2 ">
            
            @if ($user->image)
            <div class="mb-3 col-4">
                <img class="img-fluid img-thumbnail" src="{{ $user->image->url() }}" alt="img">
             </div>
            @endif
         
             <div class="form-group">
                <input 
                type="file" 
                name="profile_image" 
                id="profile_image">
                <label for="profile_image">Upload profile image</label>
             </div>
                

            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" class="form-control" value='{{ $user->name }}'>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value='{{ $user->email }}'>
            </div>

            <div class="form-group">
                <textarea name="about" placeholder="About.." id="about" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button> 
            </div>

        </form>
    </div>

@endsection