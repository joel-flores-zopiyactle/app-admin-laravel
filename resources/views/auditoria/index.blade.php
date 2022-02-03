@extends('layouts.dashboardVideo')

@section('title')
    Auditoria en celebración
@endsection

@section('video')
<div class="container-fluid">

   <div class="mb-2 mt-1 px-4 py-2 border bg-white rounded">
      <section class=mb-1">
        <b class="fs-6 text-uppercase">{{$expediente->audiencia->centroJusticia->nombre }} - {{$expediente->audiencia->tipoAudiencia->nombre }} </b>
      </section>

      <section class="d-flex justify-content-between">
         <p>Número de expediente: <b> {{ $expediente->numero_expediente }} </b></p>
         <section class="d-flex">
            <p class="me-3">Hora de inicio: {{ $expediente->audiencia->horaInicio }} </p>
            <p>Hora a finalizar: {{ $expediente->audiencia->horaFinalizar }} </p>
         </section>
      </section>
   </div>

   <div class="d-flex bd-highlight">
      {{-- Navigation --}}
      <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
         <button class="nav-link active" id="v-pills-audiencia-tab" data-bs-toggle="pill" data-bs-target="#v-pills-audiencia" type="button" role="tab" aria-controls="v-pills-audiencia" aria-selected="true"><span class="iconify h4 me-1" data-icon="carbon:video-filled"></span><br>Audiencia</button>
         <button class="nav-link" id="v-pills-asistencia-tab" data-bs-toggle="pill" data-bs-target="#v-pills-asistencia" type="button" role="tab" aria-controls="v-pills-asistencia" aria-selected="false"><span class="iconify h4 me-1" data-icon="bi:file-check-fill"></span><br>Asistencia</button>
         <button class="nav-link" id="v-pills-notas-tab" data-bs-toggle="pill" data-bs-target="#v-pills-notas" type="button" role="tab" aria-controls="v-pills-notas" aria-selected="false"><span class="iconify h4 me-1" data-icon="fa-solid:sticky-note"></span><br>Notas</button>
         <button class="nav-link" id="v-pills-archivos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-archivos" type="button" role="tab" aria-controls="v-pills-archivos" aria-selected="false"><span class="iconify h4 me-1" data-icon="ant-design:file-zip-filled"></span><br>Archivos</button>

         <a href="{{ route('salir.evento',$expediente->audiencia->id ) }}" class="nav-link text-center mt-4"
            onclick="return confirm('¿Estas seguro de salir de la audiencia?')" title="Salir de la audiencia">
            <span class="iconify h3" data-icon="majesticons:door-exit"></span><br> Salir
         </a>
        
      </div>

      <div class="w-100 tab-content bg-white p-2 shadow" id="v-pills-tabContent">
         {{-- Videograbacion --}}
         <div class="w-full tab-pane fade show active" id="v-pills-audiencia" role="tabpanel" aria-labelledby="v-pills-audiencia-tab">

            <div>
               
               <input type="text" name="numero_de_expediente" id="numero_de_expediente" value="{{ $expediente->numero_expediente }}" hidden>
               <input type="text" id="fechaCelebracion" value="{{ $expediente->audiencia->fechaCelebracion }}" hidden>
               
               <video-recording-obs />
            </div>         
         </div>

         {{-- asistencia --}}
         <div class="tab-pane fade" id="v-pills-asistencia" role="tabpanel" aria-labelledby="v-pills-asistencia-tab">

            <x-sala.table-asistencia :participantes="$expediente->audiencia->participantes" :audienciaid="$expediente->audiencia->id" />

         </div>

         {{-- Notas --}}
         <div class="tab-pane fade" id="v-pills-notas" role="tabpanel" aria-labelledby="v-pills-notas-tab">
            <x-sala.form-nota :participantes="$expediente->audiencia->participantes" :audienciaid="$expediente->id"/>
         </div>

         {{-- Archivos --}}
         <div class="tab-pane fade" id="v-pills-archivos" role="tabpanel" aria-labelledby="v-pills-archivos-tab">
            <x-sala.form-file :participantes="$expediente->audiencia->participantes" :audienciaid="$expediente->id"/>
         </div>

      </div>
   </div>
</div>
@endsection

@section('js')
     {{--  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
     {{--  <script src="{{ asset('js/sala/form-notas.js') }}"></script> --}}
     {{--  <script src="{{ asset('js/sala/form-files.js') }}"></script> --}}
     {{--  <script src="{{ asset('js/sala/asistencia.js') }}"></script> --}}
@endsection

