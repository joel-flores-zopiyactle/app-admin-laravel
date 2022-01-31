@extends('layouts.dashboard')

@section('title')
    Auditoria en celebración
@endsection

@section('content')
<div class="container">

   <div class="bg-white shadow mb-3 p-3">
      <x-alert-message />
      
      <nav>
         <div class="nav nav-tabs" id="nav-tab" role="tablist">
           <button class="nav-link active" id="nav-audiencia-tab" data-bs-toggle="tab" data-bs-target="#nav-audiencia" type="button" role="tab" aria-controls="nav-audiencia" aria-selected="true">Audiencia</button>
           <button class="nav-link" id="nav-asistencia-tab" data-bs-toggle="tab" data-bs-target="#nav-asistencia" type="button" role="tab" aria-controls="nav-asistencia" aria-selected="false">Toma de lista</button>
           <button class="nav-link" id="nav-notas-tab" data-bs-toggle="tab" data-bs-target="#nav-notas" type="button" role="tab" aria-controls="nav-notas" aria-selected="false">Control de Notas y Archivos</button>
         </div>
       </nav>

       <div class="tab-content mt-1" id="nav-tabContent">
          {{-- audiencia --}}
         <div class="tab-pane fade show active" id="nav-audiencia" role="tabpanel" aria-labelledby="nav-audiencia-tab">
            <div class="mb-3 mt-3 p-3 border rounded">
               <section class=mb-1">
                 <h4 class="h5 text-uppercase">{{$expediente->audiencia->centroJusticia->nombre }} - {{$expediente->audiencia->tipoAudiencia->nombre }} </h4>
               </section>

               <section class="d-flex justify-content-between">
                  <p>Número de Audiencia: <b> {{ $expediente->numero_expediente }} </b></p>
                  <section class="d-flex">
                     <p class="me-3">Hora de inicio: {{ $expediente->audiencia->horaInicio }} </p>
                     <p>Hora a finalizar: {{ $expediente->audiencia->horaFinalizar }} </p>
                  </section>
               </section>
            </div>
      
            <div class="row mb-5">
               <div class="col-12">
                 {{--  <video-recording> --}}
                  <input type="text" name="numero_de_expediente" id="numero_de_expediente" value="{{ $expediente->numero_expediente }}" hidden>
                  <video-recording-obs />
                  {{-- <video-recording-three/> --}}
                 
                  <hr>
               </div>               
               {{-- salir --}}
               <div class="w-100 text-center mt-5 border p-3">
                  <a href="{{ route('salir.evento',$expediente->audiencia->id ) }}" class="btn btn-primary rounded-pill px-3" onclick="return confirm('¿Estas seguro de salir de la audiencia?')">Salir de la audiencia</a>
               </div>
            </div>
   
         </div>

         <!-- asistencia -->
         <div class="tab-pane fade" id="nav-asistencia" role="tabpanel" aria-labelledby="nav-asistencia-tab">
           <x-sala.table-asistencia :participantes="$expediente->audiencia->participantes" :audienciaid="$expediente->audiencia->id" />
         </div>

         <div class="tab-pane fade" id="nav-notas" role="tabpanel" aria-labelledby="nav-notas-tab">
            <div class="row">
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                  {{-- notes --}}
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="note-tab" data-bs-toggle="tab" data-bs-target="#note" type="button" role="tab" aria-controls="note" aria-selected="true">Notas</button>
                  </li>
                  {{-- file --}}
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#files" type="button" role="tab" aria-controls="files" aria-selected="false">Archivos</button>
                  </li>
                  
                </ul>
      
                <div class="tab-content" id="myTabContent">
                   {{-- Notas --}}
                  <div class="tab-pane fade show active" id="note" role="tabpanel" aria-labelledby="note-tab">
                        <x-sala.form-nota :participantes="$expediente->audiencia->participantes" :audienciaid="$expediente->id"/>
                  </div>
                  {{-- Archivos --}}
                  <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="file-tab">
                        <x-sala.form-file :participantes="$expediente->audiencia->participantes" :audienciaid="$expediente->id"/>
                  </div>
   
                </div>
            </div>
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

