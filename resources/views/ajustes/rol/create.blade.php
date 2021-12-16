@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    
    @if (isset($rol))
        <h3>Editar Rol</h3>
    @else
       <h3>Agregar nuevo Rol</h3> 
    @endif
   
    <hr>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ isset($rol) ? route('update-rol', $rol->id) : route('post-rol') }}" method="POST" class="w-50">
        @csrf

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
            aria-describedby="rol"  value="{{ isset($rol) ? $rol->rol : old('rol') }}"> 
            @error('rol')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" 
            cols="30" rows="3">{{ isset($rol) ? $rol->descripcion : old('descripcion') }}</textarea>

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

    <div class="mt-5 d-flex align-items-center">
        <a href="{{ route('roles') }}">
            <span class="iconify h3" data-icon="bx:bxs-left-arrow-circle"></span> Regresar
        </a>
    </div>
</div>
@endsection
