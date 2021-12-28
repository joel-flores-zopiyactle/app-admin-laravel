
@extends('layouts.dashboard')

@section('title')
    Acceder Audiencia como invitado
@endsection

@section('content')
<div class="container">
   <div class="row">
    <div class="col"></div>
    <form action="{{ route('invitado.singIn') }}" method="POST" class="col-5 card p-5 shadow mt-3" autocomplete="off">
        @csrf
        @method('GET')
        <h3 class="text-center">Ingresar audiencia como invitado</h3>
        <hr>

        <div class="mb-3 mt-3">
          <label for="token" class="form-label">Ingrese su Token de acceso:</label>
          <input type="text" class="form-control @error('token') is-invalid @enderror" name="token" id="token" placeholder="Token...">
          @error('token')
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
