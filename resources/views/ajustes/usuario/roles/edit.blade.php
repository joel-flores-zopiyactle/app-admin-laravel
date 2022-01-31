@extends('layouts.dashboard')

@section('title')
Actualizar rol de usuario 
@endsection

@section('content')
<div class="container-fluid">
    
    <h3 class="fs-5 text-uppercase">Actualizar rol de usuario</h3>
   
    <hr>
    
    <form action="{{ route('update.roles.usuarios', $rol->id) }}" method="POST" class="w-50">
        @method('PUT')
        @csrf
        <x-alert-message />      

        <div class="mb-3">
            {{--  
                [isset($centro) ? $centro->nombre : old('nombre')] 
                VERIFICA SI SE ACTUALIZA O SE CREA 
            --}}

            <label for="nombre" class="form-label">Rol:</label>
            <input type="text" class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" 
            aria-describedby="rol"  value="{{ isset($rol) ? $rol->tipo : old('rol') }}" placeholder="Ingrese nuevo Rol..."> 
            @error('rol')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" 
            cols="30" rows="3" placeholder="Agregue un breve descripción acerca del Rol...">{{ isset($rol) ? $rol->descripcion : old('descripcion') }}</textarea>

            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- {{  $rol->permiso }} --}}

        <div class="my-4">
            <h2 class="fs-6">Modúlos de Acceso</h2>
            <hr>

            {{-- Permisos de módulos --}}
            <div class="row">
                {{-- id de los permisos --}}
                <input type="text" name="permiso_id" value="{{ encrypt($rol->permiso->id) }}" hidden>

                <label for="permiso_5" class="form-check-label">
                    @if ($rol->permiso->ver_auditoria)
                        <input type="checkbox" name="permiso_5" id="permiso_5" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_5" id="permiso_5" class="form-check-input me-2">
                    @endif     
                    Acceder sala
                </label>

                <label for="permiso_6" class="form-check-label">
                    @if ($rol->permiso->ver_lista_auditoria)
                        <input type="checkbox" name="permiso_6" id="permiso_6" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_6" id="permiso_6" class="form-check-input me-2">
                    @endif
                    Lista de auditorias
                </label>

                <label for="permiso_7" class="form-check-label">
                    @if ($rol->permiso->ver_reservar)
                        <input type="checkbox" name="permiso_7" id="permiso_7" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_7" id="permiso_7" class="form-check-input me-2">
                    @endif
                    Reservar audiencia
                </label>

                <label for="permiso_8" class="form-check-label">
                    @if ($rol->permiso->ver_buscar)
                        <input type="checkbox" name="permiso_8" id="permiso_8" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_8" id="permiso_8" class="form-check-input me-2">
                    @endif
                    Buscar expediente
                </label>

                <label for="permiso_9" class="form-check-label">
                    @if ($rol->permiso->ver_admin)
                        <input type="checkbox" name="permiso_9" id="permiso_9" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_9" id="permiso_9" class="form-check-input me-2">
                    @endif
                    Administración
                </label>

                <label for="permiso_10" class="form-check-label">
                    @if ($rol->permiso->ver_agenda)
                        <input type="checkbox" name="permiso_10" id="permiso_10" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_10" id="permiso_10" class="form-check-input me-2">
                    @endif
                    Agenda
                </label>

                <label for="permiso_11" class="form-check-label">
                    @if ($rol->permiso->ver_invitado)
                        <input type="checkbox" name="permiso_11" id="permiso_11" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_11" id="permiso_11" class="form-check-input me-2">
                    @endif
                    Invitado
                </label>

                <label for="permiso_12" class="form-check-label">
                    @if ($rol->permiso->ver_config)
                        <input type="checkbox" name="permiso_12" id="permiso_12" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_12" id="permiso_12" class="form-check-input me-2">
                    @endif
                    Configuraciones (Acceso completo)
                </label>

                {{-- 
                    Falta el modulo de analisis estadistico    
                --}}

                {{-- <label for="permiso_13" class="form-check-label">
                     @if ($rol->permiso->ver_estadistica)
                        <input type="checkbox" name="permiso_13" id="permiso_13" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_13" id="permiso_13" class="form-check-input me-2">
                    @endif
                  
                    Estadistica
                </label> --}}

            </div>

            {{-- permisos de lectura --}}
            <div class="row mt-3">
                <hr>

                <p class="text-black-50 text-small">
                    Para los módulos de lista de auditorías, Administración y buscar expediente seleccione el tipo de acciones a realizar.
                </p>

                <label for="permiso_1" class="form-check-label mt-3">
                    @if ($rol->permiso->agendar)
                        <input type="checkbox" name="permiso_1" id="permiso_1" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_1" id="permiso_1" class="form-check-input me-2">
                    @endif
                    Reagendar audiencias
                </label>

                <label for="permiso_2" class="form-check-label">
                    @if ($rol->permiso->eliminar)
                        <input type="checkbox" name="permiso_2" id="permiso_2" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_2" id="permiso_2" class="form-check-input me-2">
                    @endif
                    Eliminar
                </label>

                <label for="permiso_3" class="form-check-label">
                    @if ($rol->permiso->descargar)
                        <input type="checkbox" name="permiso_3" id="permiso_3" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_3" id="permiso_3" class="form-check-input me-2">
                    @endif                    
                    Imprimir y Descargar archivos 
                </label>

                <label for="permiso_4" class="form-check-label">
                    @if ($rol->permiso->cancelar)
                        <input type="checkbox" name="permiso_4" id="permiso_4" class="form-check-input me-2" checked>
                    @else
                        <input type="checkbox" name="permiso_4" id="permiso_4" class="form-check-input me-2">
                    @endif
                   
                   Cancelar audiencias
                </label>
            </div>
        </div>

        <hr>

        {{-- Checkbox de disponible --}}
        <div class="mb-3 form-check">
            @if ($rol->estado)
                <input type="checkbox" class="form-check-input" name="estado" id="estado" checked value="1">
            @else
                <input type="checkbox" class="form-check-input" name="estado" id="estado"  value="1">
            @endif
            <label class="form-check-label" for="estado">Disponible</label>
        </div>

        <button type="submit" class="btn btn-primary"> Actualizar </button>
    </form>

    <div class="my-5">
        <a class="d-flex align-content-center" href="{{ route('roles.usuarios') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>regresar</span>
        </a>
    </div>
</div>
@endsection
