@extends('layouts.layout')


@section('content')
    
<a href="{{ route('tags.create') }}"><i class="far fa-hand-point-left"></i> Back</a>
    <div class="col-8 offset-2">
        <h3 class="text-center">Tag List</h3>

       <ul class="list-group">
                @foreach ($tagList as $tag)
                  <li class="list-group-item">{{ $tag->name }} <span class="float-right "><a href="#"><i class="fas fa-trash text-danger"></i></a></span> </li>
               @endforeach
       </ul>
    </div>

@endsection