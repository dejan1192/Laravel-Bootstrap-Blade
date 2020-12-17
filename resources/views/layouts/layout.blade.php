<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href={{asset('css/app.css')}}>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://kit.fontawesome.com/f71c144e43.js" crossorigin="anonymous"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    </head>
    <body >
        <div class="navbar navbar-expand-lg mb-4 navbar-dark bg-dark">
          
             <div class="container">
                 
              <ul class="navbar-nav mr-auto">
                @auth
                <li class='nav-item' >
                  <a  class='nav-link' href="{{route('index')}}"><i class="fas fa-home"></i> Home</a>
                  </li>   
                  <li class='nav-item'><a class='nav-link'  href="{{route('users.show', Auth::user()->id)}}"><i class="fas fa-user-alt"></i> Profile</a></li>
                 
                @endauth
                
                  
                </ul>
             </div>
           
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
          <div class="container">
            @yield('content')
          </div>
      
    </body>
</html>
