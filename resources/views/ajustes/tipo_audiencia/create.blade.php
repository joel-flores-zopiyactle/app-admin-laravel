@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    
    @if (isset($audiencia))
        <h3 class="fs-5 text-uppercase">Actualizar datos del Audiencia</h3>
    @else
       <h3 class="fs-5 text-uppercase">Registrar nuevo Audiencia</h3> 
    @endif
   
    <hr>
    
    <form action="{{ isset($audiencia) ? route('update-audiencia', $audiencia->id) :route('post-audiencia') }}" method="POST" class="w-50">
        @csrf
        <x-alert-message />
        {{-- SI ACTUALIZAMOS LOS DATOS ENVIAMOS EL METODO PUT --}}
        @isset($audiencia)
            @method('PUT')
        @endisset

        <div class="mb-3">
            {{--  
                [isset($centro) ? $centro->nombre : old('nombre')] 
                VERIFICA SI SE ACTUALIZA O SE CREA 
            --}}

            <label for="nombre" class="form-label">Nombre de la Audiencia:</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" 
            aria-describedby="nombre"  value="{{ isset($audiencia) ? $audiencia->nombre : old('nombre') }}" placeholder="Ingrese el nombre de la Audiencia..."> 
            @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" 
            cols="30" rows="3"  placeholder="Agregue un breve descripción de la audiencia...">{{ isset($audiencia) ? $audiencia->descripcion : old('descripcion') }}</textarea>

            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        @isset($audiencia)
            <div class="mb-3 form-check">
                @if ($audiencia->estado)
                    <input type="checkbox" class="form-check-input" name="estado" id="estado" checked value="1">
                @else
                    <input type="checkbox" class="form-check-input" name="estado" id="estado"  value="1">
                @endif
                <label class="form-check-label" for="estado">Disponible</label>
            </div>
        @endisset

        <button type="submit" class="btn btn-primary"> {{ isset($audiencia) ? 'Actualizar' : 'Registrar' }} </button>
    </form>

    <div class="mt-5">
        <a class="d-flex align-content-center" href="{{ route('audiencias') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>regresar</span>
        </a>
    </div>
</div>
@endsection
