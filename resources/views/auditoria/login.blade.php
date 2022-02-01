
@extends('layouts.dashboard')

@section('title')
  Ingresar Audiencia
@endsection

@section('content')
<div class="container">
   <div class="row">
    <div class="col"></div>
    <form action="{{ route('evento.singIn') }}" method="POST" class="col-5 card p-5 shadow mt-3" autocomplete="off">
        @csrf
        <h3 class="text-center">Ingresar audiencia</h3>
        <hr>

        <div class="mb-3 mt-3">
          <label for="token" class="form-label">Ingrese su Token de acceso:</label>
          <input type="text" class="form-control @error('token') is-invalid @enderror" name="token" id="token" placeholder="Token...">
          @error('token')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="num_audiencia" class="form-label">Número de expediente:</label>
          <input type="text" class="form-control  @error('numero_de_expediente') is-invalid @enderror" name="numero_de_expediente" id="num_audiencia" placeholder="Número de expediente...">
          @error('numero_de_expediente')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>
    
        <button type="submit" class="btn btn-primary my-4">Ingresar</button>

        <x-alert-message />
    </form>
    <div class="col"></div>
   </div>
  
</div>
@endsection
