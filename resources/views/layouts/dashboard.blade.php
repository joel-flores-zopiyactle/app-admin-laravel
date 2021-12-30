<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>

    <!-- Custom styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    @yield('css')

    <script type="text/javascript">
        const baseURL = {!! json_encode(url('/'))  !!}
    </script>
</head>

<body>
    <div class="page-flex" id="app">
        <!-- ! Sidebar -->
        <x-nav-bar style="position: fixed;" />

        <div class="main-wrapper">
            <!-- ! Main nav -->
            <nav class="navbar navbar-light bg-white shadow-sm p-3">
                <div class="container">
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
    
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- ! Main -->
            <main>
                <div class="container-fluid p-3">
                   @yield('content')
                </div>
            </main>
            
        </div>

    </div>

    <!-- ! Footer -->
    <footer class="w-100 bg-white py-4">
        <div class="container w-100">
            <div class="text-center ">
                <p>
                    2021 © Akamatech - Sinjo
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}" defer></script> 
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <!-- Icons library -->
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')
</body>

</html>