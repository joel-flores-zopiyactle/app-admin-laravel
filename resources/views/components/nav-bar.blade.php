<div class="flex-shrink-0 p-3 bg-primary vh-100 sticky-top" style="width: 250px;">

    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-5 fw-semibold">Sinjo</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li>
            <a class="btn align-items-center rounded collapsed fw-bolder text-white" href="{{ route('home') }}">
                <span class="iconify h4 mr-1" data-icon="bx:bx-home-alt"></span>Inicio
            </a>
        </li>
    
        <li>
            <a class="btn align-items-center rounded collapsed fw-bolder text-white" href="#"> 
                <span class="iconify h4 mr-1" data-icon="fluent:people-audience-24-regular"></span>Ingresar Sala
            </a>
        </li>
      
        <li class="border-top my-3"></li>

        <ul class="list-unstyled fw-normal pb-1 small">
            <li >
                <a class="btn align-items-center rounded collapsed fs-6 fw-bolder text-white" href="{{ route('reservas-salas') }}">
                    <span class="iconify h4 mr-1" data-icon="majesticons:file-report-line"></span>Reservar Sala
                </a>
            </li>

            <li >
                <a class="btn align-items-center rounded collapsed fs-6 fw-bolder text-white" href="{{ route('buscar-expediente') }}">
                    <span class="iconify  h4 mr-1" data-icon="bx:bx-search"></span>Buscar Expediente
                </a>
            </li>
        </ul>

        <li class="mb-1">
            <button class="btn align-items-center rounded collapsed fw-bolder text-white" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                <span class="iconify h4 mr-1" data-icon="eva:settings-outline"></span>Configuraciones
            </button>
            <div class="collapse" id="dashboard-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="{{ route('centro-justicia') }}" class="link-dark rounded text-white">
                    <span class="iconify h5 mr-1" data-icon="ps:justice"></span>Centro de Justicia</a>
                </li>
                <li><a href="{{ route('salas') }}" class="link-dark rounded text-white">
                    <span class="iconify h5 mr-1" data-icon="fluent:conference-room-24-regular"></span>Salas</a>
                </li>
                <li><a href="{{ route('roles') }}" class="link-dark rounded text-white">
                    <span class="iconify h5 mr-1" data-icon="eos-icons:role-binding-outlined"></span>Roles</a>
                </li>
                <li><a href="{{ route('audiencias') }}" class="link-dark rounded text-white">
                    <span class="iconify h5 mr-1" data-icon="akar-icons:people-multiple"></span>Tipo de Audiencia</a>
                </li>
                <li><a href="{{ route('juicios') }}" class="link-dark rounded text-white">
                    <span class="iconify h4 mr-1" data-icon="healthicons:justice"></span>Tipo de Juicio
                </a></li>
            </ul>
            </div>
        </li>  
    </ul>
  </div>


