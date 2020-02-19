<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/hover-min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">
</head>
<body>

@auth

<div class="wrapper">
        <div class="dashboard-brand">
            <a href="/" class="brand-abbr d-none">R</a>
            <a href="/" class="brand-title ">Restro</a>
        </div>

        <nav class="dashboard-navbar navbar-expand-md" role="navigation">
            <div class="dashboard-nav">
                <span class="menuBtn">
                    <i class="material-icons ">menu</i>
                </span>

                <div class="d-inline-block navbar-right mr-4">
                    <div class="navbar-right-icons">
                        <i class="material-icons">notification_important</i>
                    </div>

                    <div class="user-icon">
                        <span>{{ ucfirst(substr(Auth::user()->name ,  -strlen(Auth::user()->name) , 1)) }}</span>
                    </div>

                    <div class="drop-down dropdown-profile ">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="#" class="hvr-icon-forward">
                                        <i class="material-icons hvr-icon">person_outline</i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="hvr-icon-forward">
                                        <i class="material-icons hvr-icon">lock</i>
                                        <span>Lock Screen</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="hvr-icon-forward" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons hvr-icon">vpn_key</i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </nav>
    </div>
    
    <div class="dashboard-container clearfix">

        <div class="dashboard-sidebar">
            <ul class="sidebar-list"> 
                <li class="gapper-1">

                </li>

                <li> 
                    <a class="nav-item" href="/" >
                        <i class="material-icons">dashboard</i>
                        <span>dashboard</span>
                    </a>
                </li>

                <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                        <i class="material-icons">store</i>
                        <span>Store</span>
                        <i class="material-icons arrow">keyboard_arrow_right</i>
                    </a>

                    <ul class="nav-sublist d-none">
                        <li >
                            <a class="nav-subitem" href="#">Items</a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="#">Items</a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="#">Items</a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="#">Items</a>
                        </li>
                        
                        
                    </ul>
                </li>

                <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                        <i class="material-icons">people</i>
                        <span>Employees</span>
                        <i class="material-icons arrow">keyboard_arrow_right</i>
                    </a>

                    <ul class="nav-sublist d-none">
                        <li class="nav-subitem">employee 2</li>
                        <li class="nav-subitem">hello</li>
                        <li class="nav-subitem">hello</li>
                        
                    </ul>
                </li>

            </ul>

        </div>

        <div class="dashboard-content-area">
          
            <main class="py-4">
                @yield('content')
            </main>
          
          
        </div>

    </div>

@endauth

    @guest
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   
                   <ul class="navbar-nav mr-auto">

                    </ul> 

                   
                    <ul class="navbar-nav ml-auto">
                        
                       
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
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
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @guest
            <main class="py-4">
                @yield('content')
            </main>
            @endguest
       
    </div>


    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
</body>
</html>