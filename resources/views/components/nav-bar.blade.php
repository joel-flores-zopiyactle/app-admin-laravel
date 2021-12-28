<aside class="sidebar sticky">
    <div class="sidebar-start">
        
        <div class="sidebar-head">
            <a href="{{ route('home') }}" class="logo-wrapper" title="Home">
                <div class="logo-text">
                   <h1 class="text-white h4">
                    <span class="logo-title"> {{ config('app.name', 'Laravel') }}</span>
                   </h1>
                    {{-- <span class="logo-subtitle">Dashboard</span> --}}
                </div>
            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="navbar-toggler-icon sr-only"></span>
                
               {{--  <span class="iconify h4 text-white" data-icon="heroicons-solid:menu"></span> --}}
            </button>
        </div>

        <div class="sidebar-body mb-5">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active d-flex align-items-center" href="{{ route('home') }}">
                        <span class="iconify h4 mr-2" data-icon="bx:bx-home-alt"></span> Inicio
                    </a>
                </li>

                <li>
                    <a href="{{ route('ingresar-evento') }}"><span class="iconify h4" data-icon="ri:team-fill"></span>Ingresar sala</a>
                </li>

                <li>
                    <a href="{{ route('book-new-room') }}"><span class="iconify h4" data-icon="icon-park-outline:doc-success"></span>Reservar sala</a>
                </li>

                <li>
                    <a href="{{ route('buscar-expediente') }}"><span class="iconify h4" data-icon="bx:bx-search"></span>Buscar expediente</a>
                </li>

                <li>
                    <a href="{{ route('reservas-salas') }}"><span class="iconify h4" data-icon="bx:bx-archive"></span>Administración</a>
                </li>

               
               
                <li>
                    <a href="{{ route('agenda') }}"><span class="iconify h4 me-2" data-icon="uil:calender"></span>Agenda</a>
                </li>

                <li>
                    <a href="{{ route('invitado-login') }}"><span class="iconify h4 me-2" data-icon="bx:bx-lock-open-alt"></span>Invitado</a>
                </li>

            </ul>

            <ul class="sidebar-body-menu">

                <li>
                    <a href="#" class="show-cat-btn">
                        <span class="iconify h4 me-1" data-icon="bx:bx-category-alt"></span>Configuraciones
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>

                    <ul class="cat-sub-menu">
                        <li>
                            <a href="{{ route('centro-justicia') }}"><span class="iconify h4 me-1" data-icon="ps:justice"></span>Centro de justicia</a>
                        </li>
                        <li>
                            <a href="{{ route('roles') }}"><span class="iconify h4 me-1" data-icon="eos-icons:cluster-role-binding"></span>Roles</a>
                        </li>
                        <li>
                            <a href="{{ route('salas') }}"><span class="iconify h4 me-1" data-icon="fluent:conference-room-16-filled"></span>Sala</a>
                        </li>
                        <li>
                            <a href="{{ route('audiencias') }}"><span class="iconify h4 me-1" data-icon="fluent:people-audience-20-filled"></span>Tipo de audiencia</a>
                        </li>
                        <li>
                            <a href="{{ route('juicios') }}"><span class="iconify h4 me-1" data-icon="healthicons:justice"></span>Tipo de juicio</a>
                        </li>

                        <li>
                            <a href="{{ route('usuarios') }}"><span class="iconify h4 me-1" data-icon="healthicons:justice"></span>Usuarios</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="mb-3">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="btn btn-light nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
            </ul>
        </div>
    </div>
</aside>







