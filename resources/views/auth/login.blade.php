@extends('layouts.layout')


@section('content')
@if($errors->any())
    @foreach($errors->all() as $error)
    
        <x-package-alert :msg="$error" type='danger' />
    @endforeach

@endif
   <div class="row">
       <div class="col-6 offset-3 card p-4">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <h2 class='text-center'>User Login</h2>
    
            <div class="form-group">
                <input placeholder="Email" type="text" name="email" id="email" class="form-control">
            </div>
    
            <div class="form-group">
                <input placeholder="Password" type="text" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <button type='submit' class="btn btn-primary btn-block">
                    LogIn
                </button>
            </div>
        </form>   
        <p>Don't have an account?</p>
    <p><a href="{{route('register')}}">Register</a></p>
    </div>
   </div>


@endsection