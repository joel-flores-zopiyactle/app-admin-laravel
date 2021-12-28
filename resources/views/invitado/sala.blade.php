@extends('layouts.dashboard')

@section('title')
    Sala de la audiencia
@endsection

@section('content')
<div class="container">
   
  <a class="btn btn-primary rounded-pill" href="{{ route('invitado.login') }}">Salir de la sala</a>
</div>
@endsection