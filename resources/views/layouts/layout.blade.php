<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href={{asset('css/app.css')}}>
    <script src="{{asset('js/app.js')}}"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    </head>
    <body class="container">
        <div class="navbar navbar-expand-lg mb-4">
          
             
              <ul class="navbar-nav mr-auto">
              @auth
              <li class='nav-item' >
                <a  class='nav-link' href="{{route('index')}}">Posts</a>
                </li>   
                <li class='nav-item'><a class='nav-link'  href="{{route('profile.index', Auth::user()->id)}}">Profile</a></li>
                <li class="nav-item">
                <a href="{{route('posts.create')}}" class="nav-link">
                    Create Post
                </a>
                </li>
              @endauth
              
                
              </ul>
           
             @auth
             <div class="right">
                <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
               <p class="badge badge-success">  Hello, {{Auth::user()->name}}</p>
                </div>   
             @endauth

              <form class='d-none' action="{{route('logout')}}" method='POST' id='logout-form'>
                    @csrf
              </form>
          </div>
       @yield('content')
    </body>
</html>
