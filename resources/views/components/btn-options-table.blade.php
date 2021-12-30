<div class="d-flex justify-content-center align-items-center">
    <div class="dropdown">
        {{-- btn options --}}
        <button class="btn btn-light rounded-circle d-flex justify-content-center align-items-center p-1"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="iconify h4 m-0" data-icon="fluent:more-circle-32-regular" data-rotate="90deg"></span>
        </button>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            {{-- Agendar audiencia --}}
            @if ( Auth::user()->tipoUsuario->permiso->eliminar)
            <li>
                <a class="dropdown-item" href="{{ route('edit.room', encrypt($expedienteId) ) }}">
                    <span class="iconify me-1" data-icon="uit:calender"></span>Agendar
                </a>
            </li>
            @endif
            {{-- eliminar dato --}}
            @if ( Auth::user()->tipoUsuario->permiso->eliminar)
                <li>
                    <form action="{{route('delete.room', $expedienteId)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="dropdown-item" type="submit" 
                        onclick="return confirm('¿Estas seguro de eliminar el expdiente numero : {{ $expedienteId }}?')" title="Eliminar">
                        <span class="iconify me-1" data-icon="fluent:delete-20-regular"></span>Eliminar
                        </button>
                    </form>
                </li>
            @endif

           {{--  <li>
                <a class="dropdown-item" href="#"><span class="iconify me-1" data-icon="simple-icons:jsonwebtokens"></span>Obtener Token</a>
            </li> --}}

            {{-- Imprimir expediente --}}
            @if ( Auth::user()->tipoUsuario->permiso->descargar)
            <li>
                <a class="dropdown-item" href="{{ route('show.pdf.expediente', encrypt($expedienteId)) }}"><span class="iconify me-1" data-icon="cil:print"></span>Imprimir Expediente</a>
            </li>
            @endif

            {{-- Cancelar audiencias --}}
            @if ( Auth::user()->tipoUsuario->permiso->cancelar)
            <li>
                <form action="{{route('cancelar.room', $expedienteId)}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="dropdown-item" type="submit" 
                    onclick="return confirm('¿Estas seguro de cancelar la audiencia?')" title="Eliminar">
                        <span class="iconify me-1" data-icon="fluent:calendar-cancel-16-regular"></span>Cancelar Audiencia
                    </button>
                </form>
            </li>
            @endif
        </ul>
    </div>
</div>