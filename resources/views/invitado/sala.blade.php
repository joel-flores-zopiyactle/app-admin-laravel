@extends('layouts.dashboard')

@section('title')
    Audiencia
@endsection

@section('content')
<div class="container">

  <div class="row">
      <div class="col-12">
        <h2>Audiencia</h2>
        <hr>
      </div>

      <div class="col-12 bg-white shadow p-3 rounded p-3">
          <section class="d-flex w-100 justify-content-between">
            <p>Número de expediente: <strong> {{ $expediente->numero_expediente }} </strong></p>

            <section class="d-flex">
              <p class="me-3">Hora de inicio: {{ $expediente->audiencia->horaInicio }} </p>
              <p>Hora a finalizar: {{ $expediente->audiencia->horaFinalizar }} </p>
            </section>

          </section>
          <hr>

          <div>
            <p>
              <b>Estado</b> <span class="badge px-3" style="background: {{$expediente->audiencia->estadoAudiencia->color}}">{{ $expediente->audiencia->estadoAudiencia->estado}}</span>
            </p>
          </div>
      </div>
  </div>
   
  <a class="btn btn-primary rounded-pill mt-5" href="{{ route('invitado.login') }}">Salir de la audiencia</a>
</div>
@endsection