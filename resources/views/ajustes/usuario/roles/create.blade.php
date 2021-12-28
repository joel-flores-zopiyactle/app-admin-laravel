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
