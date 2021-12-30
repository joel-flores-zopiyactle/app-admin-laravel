@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    
    <h3 class="fs-5 text-uppercase">Agregar Rol de Usuario</h3> 
   
    <hr>
    
    <form action="{{ route('post.roles.usuarios') }}" method="POST" class="w-50">
        @csrf
        <x-alert-message />
        
        <div class="mb-3">
            {{--  
                [isset($centro) ? $centro->nombre : old('nombre')] 
                VERIFICA SI SE ACTUALIZA O SE CREA 
            --}}

            <label for="nombre" class="form-label">Rol:</label>
            <input type="text" class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" 
            aria-describedby="rol"  value="{{ old('rol') }}" placeholder="Ingrese nuevo Rol..."> 
            @error('rol')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" 
            cols="30" rows="3" placeholder="Agregue un breve descripción acerca del Rol...">{{ old('descripcion') }}</textarea>

            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

       {{--  {{  $rol->permiso }} --}}

        <div class="my-4">
            <h2 class="fs-6">Modúlos de Acceso</h2>
            <hr>

            {{-- Permisos de módulos --}}
            <div class="row">
               
                <label for="permiso_5" class="form-check-label">
                    <input type="checkbox" name="permiso_5" id="permiso_5" class="form-check-input me-2">            
                    Acceder sala
                </label>

                <label for="permiso_6" class="form-check-label">
                    <input type="checkbox" name="permiso_6" id="permiso_6" class="form-check-input me-2">
                    Lista de auditorias
                </label>

                <label for="permiso_7" class="form-check-label">
                    <input type="checkbox" name="permiso_7" id="permiso_7" class="form-check-input me-2">
                    Reservar audiencia
                </label>

                <label for="permiso_8" class="form-check-label">
                    <input type="checkbox" name="permiso_8" id="permiso_8" class="form-check-input me-2">
                    Buscar expediente
                </label>

                <label for="permiso_9" class="form-check-label">
                    <input type="checkbox" name="permiso_9" id="permiso_9" class="form-check-input me-2">
                    Administracion
                </label>

                <label for="permiso_10" class="form-check-label">
                    <input type="checkbox" name="permiso_10" id="permiso_10" class="form-check-input me-2">
                    Agenda
                </label>

                <label for="permiso_11" class="form-check-label">
                    <input type="checkbox" name="permiso_11" id="permiso_11" class="form-check-input me-2">
                    Invitado
                </label>

                <label for="permiso_12" class="form-check-label">
                    <input type="checkbox" name="permiso_12" id="permiso_12" class="form-check-input me-2">
                    Configuraciones (Acceso completo)
                </label>

                {{-- 
                    Falta el modulo de analisis estadistico    
                --}}

                {{-- <label for="permiso_13" class="form-check-label">
                    <input type="checkbox" name="permiso_13" id="permiso_13" class="form-check-input me-2">
                    Estadistica
                </label> --}}

            </div>

            {{-- permisos de lectura --}}
            <div class="row mt-3">
                <hr>

                <p class="text-black-50 text-small">
                    Para los mudulos de lista de auditorias, Administración y buscar expediente seleccione el tipo de acciones a realizar. 
                </p>

                <label for="permiso_1" class="form-check-label mt-3">
                    <input type="checkbox" name="permiso_1" id="permiso_1" class="form-check-input me-2">
                    Reagendar Audiencias
                </label>

                <label for="permiso_2" class="form-check-label">
                    <input type="checkbox" name="permiso_2" id="permiso_2" class="form-check-input me-2">
                    Eliminar
                </label>

                <label for="permiso_3" class="form-check-label">
                    <input type="checkbox" name="permiso_3" id="permiso_3" class="form-check-input me-2">
                    Imprimir y Descargar Archivios 
                </label>

                <label for="permiso_4" class="form-check-label">
                    <input type="checkbox" name="permiso_4" id="permiso_4" class="form-check-input me-2">
                   Cancelar Audiencias
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

    <div class="my-5">
        <a class="d-flex align-content-center" href="{{ route('roles.usuarios') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>regresar</span>
        </a>
    </div>
</div>
@endsection
