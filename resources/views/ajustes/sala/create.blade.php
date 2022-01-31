@extends('layouts.dashboard')

@section('title')
    @if (isset($sala))
        Actualizar sala
    @else
     Registrar nueva Sala
    @endif
@endsection

@section('content')
<div class="container-fluid">
    
    @if (isset($sala))
        <h3 class="fs-5 text-uppercase">Actualizar datos de la Sala</h3>
    @else
       <h3 class="fs-5 text-uppercase">Registrar Sala</h3> 
    @endif
   
    <hr>
    

    <form action="{{ isset($sala) ? route('update.sala', $sala->id) : route('post.sala') }}" method="POST" class="w-50">
        @csrf
        <x-alert-message />

        {{-- SI ACTUALIZAMOS LOS DATOS ENVIAMOS EL METODO PUT --}}
        @isset($sala)
            @method('PUT')
        @endisset

        <div class="mb-3">
            {{--  
                [isset($centro) ? $centro->nombre : old('nombre')] 
                VERIFICA SI SE ACTUALIZA O SE CREA 
            --}}

            <label for="sala" class="form-label">Sala:</label>
            <input type="text" class="form-control @error('sala') is-invalid @enderror" id="sala" name="sala" placeholder="Ingrese el nombre de la sala" 
            aria-describedby="sala"  value="{{ isset($sala) ? $sala->sala : old('sala') }}"> 
            @error('sala')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">

            <div class="col-6">
                <div class="mb-3">
                    <label for="numero" class="form-label">Número de sala:</label>
                    <input type="number" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" placeholder="Número de sala" 
                    aria-describedby="numero"  value="{{ isset($sala) ? $sala->numero : old('numero') }}"> 
                    @error('numero')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="capacidad" class="form-label">Capacidad de sala:</label>
                    <input type="number" class="form-control @error('capacidad') is-invalid @enderror" id="capacidad" name="capacidad" placeholder="Capacidad de sala" 
                    aria-describedby="capacidad"  value="{{ isset($sala) ? $sala->capacidad : old('capacidad') }}"> 
                    @error('capacidad')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>       

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación:</label>
            <textarea name="ubicacion" id="ubicacion" class="form-control  @error('ubicacion') is-invalid @enderror" 
            cols="30" rows="2" placeholder="Agregue un breve descripción de la ubicación de la sala...">{{ isset($sala) ? $sala->ubicacion : old('ubicacion') }}</textarea>

            @error('ubicacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @isset($sala)
            <div class="mb-3 form-check">
                @if ($sala->estado)
                    <input type="checkbox" class="form-check-input" name="estado" id="estado" checked value="1">
                @else
                    <input type="checkbox" class="form-check-input" name="estado" id="estado"  value="1">
                @endif
                <label class="form-check-label" for="estado">Disponible</label>
            </div>
        @endisset

        <button type="submit" class="btn btn-primary"> {{ isset($sala) ? 'Actualizar' : 'Registrar' }} </button>
    </form>

    <div class="mt-5">
        <a class="d-flex align-content-center" href="{{ route('salas') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>Regresar</span>
        </a>
    </div>
</div>
@endsection
