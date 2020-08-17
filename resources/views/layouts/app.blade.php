<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restro') }}</title>

    

    {{-- icon    --}}
    <link rel="icon" href="">

    <!-- Font Style -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">  

    <!-- Styles -->
    <link href="{{ asset('css/hover-min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/switch.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dataTable/dataTable.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/dataTable/dataTable.min.css')}}"> 
   


    {{-- Custom Style Sheet Addition Template --}}
    @yield('addStyle')

    {{-- Custom Style Sheet --}}
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
                    <i class="fas fa-bars"></i>
                </span>

                <div class="d-inline-block navbar-right mr-4">
                    <div class="navbar-right-icons">
                    <i class="fas fa-bell"></i>
                        
                    </div>

                    <div class="user-icon">
                        <span>{{ ucfirst(substr(Auth::user()->name ,  -strlen(Auth::user()->name) , 1)) }}</span>
                    </div>

                    <div class="drop-down dropdown-profile ">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="#" class="hvr-icon-forward">
                                    <i class="far fa-user hvr-icon"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="hvr-icon-forward">
                                        <i class="fas fa-lock hvr-icon"></i>
                                        <span>Lock Screen</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="hvr-icon-forward" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-key hvr-icon"></i>
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
                        <i class="fas fa-tachometer-alt"></i>
                        <span>dashboard</span>
                    </a>
                </li>


                <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                    <i class="fas fa-users"></i>
                        <span>Employees</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>

                    <ul class="nav-sublist d-none">
                        <li >
                            <a class="nav-subitem" href="{{route('employee.index')}}" >
                                Employees
                            </a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="{{route('designation.index')}}" >
                              Desgination
                            </a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="{{route('staff.index')}}" >
                              Staff Group
                            </a>
                        </li>
                    </ul>
                </li>

                <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                    <i class="fas fa-book-reader"></i>
                        <span>Menu</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>

                    <ul class="nav-sublist d-none">
                        
                        <li >
                            <a class="nav-subitem" href="{{route('menuCatagory.index')}}">Catagories</a>
                        </li>

                        {{-- <li >
                            <a class="nav-subitem" href="{{route('menuCatagory.create')}}">Create Catagory</a>
                        </li> --}}

                        <li >
                            <a class="nav-subitem" href="{{route('products.all')}}">Products</a>
                        </li>

                        <li class="nav-subitem">Menu</li>
    
                    </ul>
                </li>


                <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                    <i class="fas fa-poll"></i>
                        <span>Reports</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>

                    <ul class="nav-sublist d-none">
                        
                        <li class="nav-subitem">reports</li>
                        
                    </ul>
                </li>


                <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-store"></i>
                        <span>Store</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>

                    <ul class="nav-sublist d-none">

                        <li >
                            <a class="nav-subitem" href="{{route('catagory.index')}}">catagories</a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="{{route('rawItem.all')}}">items</a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="{{ route('purchase.index')}}">purchases</a>
                        </li>
                        <li >
                            <a class="nav-subitem" href="{{ route('vendor.index')}}">vendors</a>
                        </li>

                        
                        
                    </ul>
                </li>

                {{-- <li > 
                    <a class="nav-dropdown" href="#"  data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-user-alt"></i>
                        <span>Vendor</span>
                        <i class="fas fa-chevron-right arrow"></i>
                    </a>

                    <ul class="nav-sublist d-none">
                        <li >
                            <a class="nav-subitem" href="{{route('vendor.index')}}">All Vendors</a>
                        </li>

                        <li >
                            <a class="nav-subitem" href="{{route('vendor.newVendor')}}">New Vendor</a>
                        </li>
                        
                    </ul>
                </li> --}}
               

            </ul>

        </div>

        <div class="dashboard-content-area">
          
            <main >
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
                   
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            @endguest
        </nav>

        @guest
            <main class="py-1">
                @yield('content')
            </main>
            
        </div>
        @endguest


    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/dataTable/dataTable.min.js')}}"></script>

    @yield('addJavaScript')

    <script src="{{asset('js/dashboard.js')}}"></script>

</body>
</html>
