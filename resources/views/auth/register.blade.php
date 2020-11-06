@extends('layouts.layout')


@section('content')
@if($errors->any())
    @foreach($errors->all() as $error)
    
        <x-package-alert :msg="$error" type='danger' />
    @endforeach

@endif
   <div class="row">
       <div class="col-6 offset-3 card p-4">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <h2 class='text-center'>User Registration</h2>
    
            <div class="form-group">
                <input placeholder="name" type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <input placeholder="Email" type="text" name="email" id="email" class="form-control">
            </div>
    
            <div class="form-group">
                <input placeholder="Password" type="text" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <input placeholder="Confirm Password" type="text" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <button type='submit' class="btn btn-primary btn-block">
                    Register
                </button>
            </div>
        </form>   
        
    </div>
   </div>


@endsection