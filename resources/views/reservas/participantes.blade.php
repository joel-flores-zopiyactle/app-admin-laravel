@extends('layouts.dashboard')

@section('title')
   Participantes
@endsection

@section('content')
  <div class="container-fluid">
    <div>
      <h2 class="fs-5 text-uppercase">Agregar lista de participantes</h2>
      <hr>
    </div>

   <div>
    <x-alert-message />
   </div>

    <div>
        <form  action="{{ route('post.participante') }}" method="POST">
          @csrf
         <div class="mb-2">
           <input type="hidden" value="{{ $id }}" name="audiencia_id">
          <form-add-users />
         </div>

          <div>
            <button type="submit"  class="btn btn-primary">Generar expediente</button>
          </div>
        </form>
    </div>
  </div>  
@endsection
