@extends('layouts.layout')


@section('content')
    
  <div class="row">
    <div class="col-6 card p-2">
        <h4>Create Tag</h4>
        <form action="{{ route('tags.store') }}" method="post">
            @csrf
            
            <div class="form-group">
                <input class="form-control" type="text" name="tag_name" id="tag_name" placeholder="Tag name">
            </div>

            <input class="btn btn-info text-white" type="submit" value="Save">
        </form>
    </div>
    <div class="col-3 offset-3">
        <h5 class="text-center">Tag list</h5>
     
              <x-tags :tags="$availableTags"/>
      

              <br>
              <a href="{{ route('tags.index') }}">Tag List</a>
    </div>
  </div>
    
@endsection