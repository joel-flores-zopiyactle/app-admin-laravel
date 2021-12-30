@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    
    @if (isset($rol))
        <h3 class="fs-5 text-uppercase">Actualizar rol de usuario</h3>
    @else
       <h3 class="fs-5 text-uppercase">Agregar Rol de Usuario</h3> 
    @endif
   
    <hr>
    
    <form action="{{ isset($rol) ? route('update.roles.usuarios', $rol->id) : route('post.roles.usuarios') }}" method="POST" class="w-50">
        @csrf
        <x-alert-message />
        {{-- SI ACTUALIZAMOS LOS DATOS ENVIAMOS EL METODO PUT --}}
        @isset($rol)
            @method('PUT')
        @endisset

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

        <hr>
        <h4 class="mb-1 h5">Persmisos</h4>
        <div class="row mb-3">
            
            <label class="col-12 mb-2" for="rol_1">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_1">
                Control de configuraciones (Todo)
            </label>

            <label class="col-12 mb-2" for="rol_2">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_2">
                Ingresar sala
            </label>

            <label class="col-12 mb-2" for="rol_3">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_3">
               Visualizar lista de auditorias
            </label>

            <label class="col-12 mb-2" for="rol_4">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_4">
                Reservar sala 
            </label>

            <label class="col-12 mb-2" for="rol_5">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_5">
                Buscar expediente 
            </label>

            <label class="col-12 mb-2" for="rol_6">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_6">
                Administracion 
            </label>

            <label class="col-12 mb-2" for="rol_7">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_7">
                Visualizar agenda
            </label>

            <label class="col-12 mb-2" for="rol_8">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_8">
                Invitado
            </label>
        </div>

        <section>
            <p>Para los permisos de Auditorias, Administracion y busqueda de expedientes,s eleccione las permisos que tendra este rol. </p>
        </section>
        <div class="row my-3">

            <label class="col-4 mb-2" for="rol_9">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_9">
                Editar
            </label>

            <label class="col-4 mb-2" for="rol_10">
                <input type="checkbox" class="form-check-input" name="rol" id="rol_10">
                Eliminar
            </label>
        </div>

        


        @isset($rol)
            <div class="mb-3 form-check">
                @if ($rol->estado)
                    <input type="checkbox" class="form-check-input" name="estado" id="estado" checked value="1">
                @else
                    <input type="checkbox" class="form-check-input" name="estado" id="estado"  value="1">
                @endif
                <label class="form-check-label" for="estado">Disponible</label>
            </div>
        @endisset

        <button type="submit" class="btn btn-primary"> {{ isset($rol) ? 'Actualizar' : 'Registrar' }} </button>
    </form>

    <div class="mt-5">
        <a class="d-flex align-content-center" href="{{ route('roles.usuarios') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>regresar</span>
        </a>
    </div>
</div>
@endsection
