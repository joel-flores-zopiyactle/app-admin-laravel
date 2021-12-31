@extends('layouts.dashboard')

@section('title')
   Inicio
@endsection

@section('content')
<div class="container">
    {{-- info user --}}
   <div class="bg-white shadow p-3 rounded d-flex justify-content-between align-items-center">
      <section>
         <h4>Bienvenido: {{ Auth::user()->name }}</h2>
      </section>

      <section>
         <h4 class="fs-6 text-dark-50">Tipo de usuario: <b>{{ Auth::user()->tipoUsuario->tipo }}</b></h2>
      </section>
   </div>

   {{-- Audiencias --}}
   <div class="row mt-3">
      <div class="col-6 mb-4">
         <div class="bg-white shadow p-3 rounded">
            <h5>
               <span class="iconify h4" data-icon="uil:calender"></span>
               Audiencias programadas del día de hoy</h5>
            <hr>
            @if (!count($audienciasCelebrandoseHoy) > 0)
            <ul class="mt-3 list-group-items">
               @foreach ($audienciasAgendadasHoy as $audiencia)
                  <li> {{ $audiencia->tipoAudiencia->nombre }} - Hora de inicio: <b>{{  $audiencia->horaInicio }}</b> </li>
               @endforeach
            </ul>
            @else
               <h3 class="fs-5 my-4">No hay audiencias programadas para el día de hoy</h3>   
            @endif
         </div>
      </div>

      {{-- Audiencias celebrandose  --}}
      <div class="col-6 mb-4">

         <div class="bg-white shadow p-3 rounded">
            <h5>
               <span class="iconify h4" data-icon="uil:calender"></span>
               Audiencias celebrándose</h5>
            <hr>

            @if (!count($audienciasCelebrandoseHoy) > 0)
               <ul class="mt-5 list-group-items">
                  @foreach ($audienciasCelebrandoseHoy as $audiencia)
                     <li> {{ $audiencia->tipoAudiencia->nombre }} - Hora de inicio: <b>{{  $audiencia->horaInicio }}</b> </li>
                  @endforeach
               </ul>
            @else
               <h3 class="fs-5 my-4">No hay audiencias celebrándose en este momento</h3>   
            @endif
           
         </div>
      </div>

      {{-- Audiencias finalizadas  --}}
      <div class="col-6 mb-4">

         <div class="bg-white shadow p-3 rounded">
            <h5>
               <span class="iconify h4" data-icon="uil:calender"></span>
               Audiencias finalizadas del día de hoy</h5>
            <hr>

            @if (count($audienciasFinalizadasHoy) > 0)
               <ul class="mt-5 list-group-items">
                  @foreach ($audienciasFinalizadasHoy as $audiencia)
                     <li> {{ $audiencia->tipoAudiencia->nombre }} - Hora de inicio: <b>{{  $audiencia->horaInicio }}</b> </li>
                  @endforeach
               </ul>
            @else
               <h3 class="fs-5 my-4">No hay audiencias finalizadas para mostrar</h3>   
            @endif
           
         </div>

      </div>
   </div>
@endsection
