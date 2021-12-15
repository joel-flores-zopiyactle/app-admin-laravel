@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h4>Registrar nuevo centro de justicia</h4>
    <hr>
    
    <form action="{{ route('centro-post') }}" method="POST" class="w-50">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" aria-describedby="nombre">
            @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
         <textarea name="descripcion" id="decs" class="form-control  @error('descripcion') is-invalid @enderror" cols="30" rows="3"></textarea>
         @error('descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection
