<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> CARDIO PROTECTION GHANA</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="row">
        @yield('chartjs')
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    CARDIO PROTECTION GHANA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                          
                        @else
                        @if (Auth::user()->role=="Nurse")
                        @include("layouts._nurse")
                        @endif
                        @if (Auth::user()->role=="Doctor")
                        @include("layouts._doctor")
                        @endif
                        @if (Auth::user()->role=="Admin")
                        @include("layouts._admin")
                        @endif
                            <li class="nav-item dropdown">
                       
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @if (Auth::user()->role=="Doctor")
                                        <a class="dropdown-item" href="{{ route('register') }}">Register Users</a>
                                @endif
                                </div>
                                
                            </li>
                           
                

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
                <div class="row justify-content-center no-gutters">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                @yield('progress')
                      
                      
                        </div>
                        <div class="col-md-2"></div>
                        </div>
                    <br>


                <div class="container-fluid">
                   
                        @if(Session::has('warn_message'))
                            <div class="alert alert-danger">
                                {{ Session::get('warn_message') }}
                            </div>
                        @endif
                         
                         <div class="container-fluid">
                                @if(Session::has('flash_message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('flash_message') }}
                                    </div>
                                @endif
                            
                        </div> 
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row no-gutters">
                            <div class="col-md-1"></div>
                       
                            <div class="col-md-10">
                                    @yield('content')
        </div>
            <div class="col-md-1"></div>
                    </div>
                </div>
                
                    
        </main>
     
    </div>
    <script>
        window.onload = function () {

            @yield('scripts')
            
        }
        </script>
</body>
</html>
