
@extends('layouts.dashboard')

@section('title')
    Acceder Audiencia
@endsection

@section('content')
<div class="container">
   <div class="row">
    <div class="col"></div>
    <form class="col-5 card p-5 shadow mt-3">
        
        <h3 class="text-center">Ingresar audiencia</h3>
        <hr>

        <div class="mb-3 mt-3">
          <label for="token" class="form-label">Ingrese su Token de acceso:</label>
          <input type="text" class="form-control" name="token" id="token" placeholder="Token...">
        </div>
        <div class="mb-3">
          <label for="num_audiencia" class="form-label">Numero de expediente:</label>
          <input type="number" class="form-control" id="num_audiencia" placeholder="Número de expediente...">
        </div>
    
        <button type="submit" class="btn btn-primary my-4">Ingresar</button>
    </form>
    <div class="col"></div>
   </div>
  
</div>
@endsection
