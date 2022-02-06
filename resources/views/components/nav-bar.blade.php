<div class="vh-100 bg-white pt-4 px-2 overflow-scroll">
    <ul class="list-unstyled ps-0">

        <li class="mb-1 mt-3" >
            <div class="mb-3 d-flex justify-content-center">
                <div class="avatar" style="background-image: url({{ asset(Storage::url(Auth::user()->avatar)) }})"></div>
            </div>
            <p class=" text-center w-100"> {{ Auth::user()->name }}</p>
        </li>

        <li class="mb-1" >
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{ route('home') }}" class="link-dark rounded">
                        <span class="iconify h4 me-1" data-icon="bx:bx-home-alt"></span>Inicio
                    </a>
                </li>
            </ul>
        </li>

        {{-- Auditoria --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_auditoria || Auth::user()->tipoUsuario->permiso->ver_lista_auditoria )
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Audiencia
                </button>
                <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-2 small">
                    @if (Auth::user()->tipoUsuario->permiso->ver_auditoria)
                        <li>
                            <a href="{{ route('ingresar.evento') }}" class="link-dark rounded">
                                <span class="iconify h4 me-1" data-icon="ri:team-fill"></span>
                                Ingresar Audiencia
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->tipoUsuario->permiso->ver_lista_auditoria)
                        <li>
                            <a href="{{ route('auditoria.lista') }}" class="link-dark rounded">
                                <span class="iconify h4 me-1" data-icon="tabler:report-search"></span>
                                Reporte
                            </a>
                        </li>
                    @endif
                </ul>
                </div>
            </li>
        @endif

        <li class="border-top my-3"></li>

        @if (Auth::user()->tipoUsuario->permiso->ver_reservar)
            <li class="mb-1 me-2" >
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('book.new.room') }}" class="link-dark rounded">
                            <span class="iconify h4 me-1" data-icon="fluent:calendar-agenda-28-regular"></span>
                            Agendar audiencia
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        {{-- Buscar expediente --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_buscar)
        <li class="mb-1" >
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a  href="{{ route('buscar.expediente') }}" class="link-dark rounded">
                        <span class="iconify h4 me-1" data-icon="bx:bx-search"></span>
                        Buscar audiencia
                    </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- Administración --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_admin)
        <li class="mb-1" >
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{ route('reservas.salas') }}" class="link-dark rounded">
                        <span class="iconify h4 me-1" data-icon="bx:bx-archive"></span>
                        Administración
                    </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- Agenda --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_agenda)
        <li class="mb-1" >
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{ route('agenda') }}" class="link-dark rounded">
                        <span class="iconify h4 me-1" data-icon="uil:calender"></span>
                        Agenda
                    </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- Analisis --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_estadistica)
        <li class="mb-1" >
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{ route('analisis.index') }}" class="link-dark rounded">
                        <span class="iconify h4 me-1" data-icon="carbon:chart-line-data"></span>
                        Análisis estadístico
                    </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- Sala de Invitado --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_invitado)
        <li class="mb-1" >
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{ route('invitado.login') }}" class="link-dark rounded">
                        <span class="iconify h4 me-1" data-icon="bx:bx-lock-open-alt"></span>
                        Invitado
                    </a>
                </li>
            </ul>
        </li>
        @endif

        {{-- Configuraciones del sistema  --}}
        @if (Auth::user()->tipoUsuario->permiso->ver_config)
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Configuraciones
            </button>
            <div class="collapse" id="orders-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-2 small">
                <li><a href="{{ route('centro.justicia') }}"    class="link-dark rounded"><span class="iconify h4 me-1" data-icon="ps:justice"></span>Centro de justicia</a></li>
                <li><a href="{{ route('roles') }}"              class="link-dark rounded"><span class="iconify h4 me-1" data-icon="eos-icons:cluster-role-binding"></span>Roles</a></li>
                <li><a href="{{ route('salas') }}"              class="link-dark rounded"><span class="iconify h4 me-1" data-icon="fluent:conference-room-16-filled"></span>Sala</a></li>
                <li><a href="{{ route('audiencias') }}"         class="link-dark rounded"><span class="iconify h4 me-1" data-icon="fluent:people-audience-20-filled"></span>Tipo de audiencias</a></li>
                <li><a href="{{ route('juicios') }}"            class="link-dark rounded"><span class="iconify h4 me-1" data-icon="healthicons:justice"></span>Tipo de juicios</a></li>
                <li><a href="{{ route('usuarios') }}"           class="link-dark rounded"><span class="iconify h4 me-1" data-icon="gridicons:multiple-users"></span>Control de usuarios</a></li>
                <li><a href="{{ route('config.obs') }}"         class="link-dark rounded"><span class="iconify h4 me-1" data-icon="simple-icons:obsstudio"></span>OBS</a></li>
            </ul>
            </div>
        </li>
        @endif
    
        <li class="border-top my-3 mb-5"></li>
    </ul>
</div>






