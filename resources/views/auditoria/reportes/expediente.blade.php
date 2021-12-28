@extends('layouts.dashboard')

@section('title')
    Lista de Auditorias
@endsection

@section('content')
<div class="container">
  <div>
      <h5>Datos de la audiencia</h5>
      <hr>
  </div>

  <div>
      {{ $expediente }}
  </div>

</div>
@endsection
