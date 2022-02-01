@extends('layouts.dashboard')

@section('title')
    Actualizar centro de justicia
@endsection

@section('content')
<div class="container-fluid">
    
    @if (isset($centro))
        <h3 class="fs-5 text-uppercase">Actualizar datos del centro de justicia</h3>
    @else
       <h3 class="fs-5 text-uppercase">Registrar nuevo Centro De Justicia</h3> 
    @endif
   
    <hr>

    
    <form action="{{ isset($centro) ? route('update.centro', $centro->id) :route('post.centro') }}" method="POST" class="w-50">

        <x-alert-message/>

        @csrf

        {{-- SI ACTUALIZAMOS LOS DATOS ENVIAMOS EL METODO PUT --}}
        @isset($centro)
            @method('PUT')
        @endisset

        <div class="mb-3">
            {{--  
                [isset($centro) ? $centro->nombre : old('nombre')] 
                VERIFICA SI SE ACTUALIZA O SE CREA 
            --}}

            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" 
            aria-describedby="nombre"  value="{{ isset($centro) ? $centro->nombre : old('nombre') }}" placeholder="Ingrese el nombre del centro de Justicia"> 
            @error('nombre')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" 
            cols="30" rows="3" placeholder="Agregue un breve descripción acerca del Centro de Justicia">{{ isset($centro) ? $centro->descripcion : old('descripcion') }}</textarea>

            @error('descripcion')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>


        @isset($centro)
            <div class="mb-3 form-check">
                @if ($centro->estado)
                    <input type="checkbox" class="form-check-input" name="estado" id="estado" checked value="1">
                @else
                    <input type="checkbox" class="form-check-input" name="estado" id="estado"  value="1">
                @endif
                <label class="form-check-label" for="estado">Disponible</label>
            </div>
        @endisset

        <button type="submit" class="btn btn-primary"> {{ isset($centro) ? 'Actualizar' : 'Registrar' }} </button>
    </form>

    <div class="mt-5">
        <a class="d-flex align-content-center" href="{{ route('centro.justicia') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>regresar</span>
        </a>
    </div>
</div>
@endsection
