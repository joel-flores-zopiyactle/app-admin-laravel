<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>
    <link rel="shortcut icon" href="{{ asset('img/icon.jpg')}}" type="image/x-icon">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebars.css') }}">
    <link rel="stylesheet" href="{{ asset('css/avatar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    @yield('css')

    <script type="text/javascript">
        const baseURL = {!! json_encode(url('/'))  !!}
    </script>

  </head>
  <body>

    <div class="fixed-top">
        <header class="navbar navbar-light bg-white flex-md-nowrap p-0 shadow" style="z-index: 200;">
            <div class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center bg-white">
                <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="Argumentalia">
            </div>
                
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="navbar-nav">
                <div class="nav-item">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown me-5">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>    
                        </li>
                    </ul>
                </div>
            </div>
    
        </header>
    </div>
    

    <div class="container-fluid wh-100" id="app" style="z-index: 1;">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse  bg-brown text-white">
                <div class="position-sticky">
                    <x-nav-bar />
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 mb-5 mt-5">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/sidebars.js') }}"></script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    @yield('js')
    </body>
</html>
