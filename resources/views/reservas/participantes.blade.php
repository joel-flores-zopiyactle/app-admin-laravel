@extends('layouts.dashboard')

@section('title')
   Participantes
@endsection

@section('content')
  <div class="container-fluid">
    <div>
      <h2 class="fs-5 text-uppercase">Registrar participantes a la audiencia</h2>
      <hr>
    </div>

   <div>
    <x-alert-message />
   </div>

    <div>
        <form  action="{{ route('post.participante') }}" method="POST" autocomplete="off">
          @csrf
          <div class="mb-2">
            <input type="hidden" value="{{ $id }}" name="audiencia_id">
            <input type="hidden" value="{{ $expediente_id }}" name="expediente_id">
            
            <form-add-users />
          </div>

          <div>
            <button type="submit"  class="btn btn-primary" 
            onclick="return confirm('¿Estas seguro de finalizar el expediente? \nRevise bien sus datos ingresados, una vez finalizada ya no podras editar los datos de los integrantes..')"
            >Generar expediente</button>
          </div>
        </form>
    </div>
  </div>  
@endsection
