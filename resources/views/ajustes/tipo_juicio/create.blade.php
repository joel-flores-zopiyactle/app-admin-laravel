@extends('layouts.dashboard')

@section('title')
    @if (isset($juicio))
        Actualizar datos del Juicio
    @else
       Registrar nuevo Juicio 
    @endif
@endsection

@section('content')
<div class="container-fluid">
    
    @if (isset($juicio))
        <h3 class="fs-5 text-uppercase">Actualizar datos del Juicio</h3>
    @else
       <h3 class="fs-5 text-uppercase">Registrar nuevo Juicio</h3> 
    @endif
   
    <hr>
   
   
    <form action="{{ isset($juicio) ? route('update.juicio', $juicio->id) : route('post.juicio') }}" method="POST" class="w-50">
        @csrf

        <x-alert-message />

        {{-- SI ACTUALIZAMOS LOS DATOS ENVIAMOS EL METODO PUT --}}
        @isset($juicio)
            @method('PUT')
        @endisset

        <div class="mb-3">
            {{--  
                [isset($centro) ? $centro->nombre : old('nombre')] 
                VERIFICA SI SE ACTUALIZA O SE CREA 
            --}}

            <label for="nombre" class="form-label">Nombre del Juicio:</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Ingrese nombre del Juicio..."
            aria-describedby="nombre"  value="{{ isset($juicio) ? $juicio->nombre : old('nombre') }}"> 
            @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" 
            cols="30" rows="3"  placeholder="Agregue un breve descripción del Juicio...">{{ isset($juicio) ? $juicio->descripcion : old('descripcion') }}</textarea>

            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        @isset($juicio)
            <div class="mb-3 form-check">
                @if ($juicio->estado)
                    <input type="checkbox" class="form-check-input" name="estado" id="estado" checked value="1">
                @else
                    <input type="checkbox" class="form-check-input" name="estado" id="estado"  value="1">
                @endif
                <label class="form-check-label" for="estado">Disponible</label>
            </div>
        @endisset

        <button type="submit" class="btn btn-primary"> {{ isset($juicio) ? 'Actualizar' : 'Registrar' }} </button>
    </form>

    <div class="mt-5">
        <a class="d-flex align-content-center" href="{{ route('juicios') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>regresar</span>
        </a>
    </div>
</div>
@endsection
