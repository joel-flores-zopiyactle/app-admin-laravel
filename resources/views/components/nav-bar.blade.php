<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <span class="iconify" data-icon="fontelico:emo-happy"></span>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <span class="iconify" data-icon="fluent:home-16-filled"></span>  <span>Inicio</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <span class="iconify" data-icon="fluent:people-audience-20-filled"></span>  <span>Ingresar sala</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Audiencia</a>
            
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('audience') }}">Audiencia</a></li>
              <li><a class="dropdown-item" href="#">Sala</a></li>
            </ul>
        </li>
    </div>  

    <!-- Heading -->
    <div class="sidebar-heading">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Configuraciones</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('centro-justicia') }}">Centro de justicia</a></li>
              <li><a class="dropdown-item" href="{{ route('salas') }}">Sala</a></li>
              <li><a class="dropdown-item" href="{{ route('roles') }}">Roles</a></li>
              <li><a class="dropdown-item" href="#">Tipo de Audiencia</a></li>
            </ul>
        </li>
    </div>   
</ul>