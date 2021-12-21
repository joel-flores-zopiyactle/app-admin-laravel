@extends('layouts.dashboard')

@section('content')
<div class="container">

   <div class="bg-white shadow mb-3 p-3">

      <div class="mb-2">
         <section>
           <h3> <b>Audiencia</b>: {{$expediente->audiencia->tipoAudiencia->nombre }}</h3>
         </section>
      </div>

      <div class="row">
         <div class="col-5">
            <div class="w-100 overflow-hidden">
               <img src="{{ asset('img/sinjo_logo.png') }}" class="img-fluid rounded border" alt="logo">
            </div>
   
            <div>
               <div class="d-flex justify-content-center mt-2">
                  <button class="btn btn-primary me-2">Play</button>
                  <button class="btn btn-warning me-2">Pause</button>
                  <button class="btn btn-danger">Finalizar</button>
               </div>
            </div>
         </div>
   
         <div class="col-7">
            <h3>Lista de participantes</h3>

            <table class="table mt-1">
               <thead class="table-primary">
                 <tr class="text-center">
                   <th scope="col">Participante</th>
                   <th scope="col">Rol</th>
                 </tr>
               </thead>
               <tbody>
                  @foreach ($expediente->audiencia->participantes as $participante)
                     <tr class="text-center">
                        <td style="width: 50%">{{ $participante->nombre }}</td>
                        <td style="width: 50%">{{ $participante->rol->rol }}</td>
                     </tr>
                  @endforeach   
               </tbody>
             </table>
         </div>
      </div>
      <div class="row">
         <div class="col-6">
            <hr>
            <h4 class="mt-1">Notas</h4>

            <table class="table mt-1">
               <thead class="table-primary">
                 <tr class="text-center">
                   <th scope="col">Nota</th>
                 </tr>
               </thead>
               <tbody>
                  <tr class="text-center">
                     <td style="width: 50%">{{ 'Nota 1' }}</td>
                    
                  </tr>   
               </tbody>
             </table>
         </div>
         <div class="col-6">
            <form action="#">
               <div class="mb-3">
                  <label for="formFile" class="form-label">Default file input example</label>
                  <input class="form-control" type="file" id="formFile">
                </div>
            </form>
         </div>
      </div>
   </div>
   
   


</div>
@endsection
