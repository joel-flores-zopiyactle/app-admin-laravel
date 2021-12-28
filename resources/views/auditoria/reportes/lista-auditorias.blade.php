@extends('layouts.dashboard')

@section('title')
    Lista de Auditorias
@endsection

@section('content')
<div class="container">
  <div>
      <h5>Lista de expedientes de las auditorias</h5>
      <hr>
  </div>

  <div class=" bg-white p-3 shadow rounded">
    <table class="table table-responsive table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <td>Num. Expediente</td>
                <td>Folio</td>
                <td>Tipo de audiencia</td>
                <td>Sala</td>
                <td>Fecha celebración</td>
                <td></td>
            </tr>
        </thead>
  
        <tbody>
            @foreach ($auditorias as $auditoria)
              <tr>
                  <td> {{ $auditoria->expediente->id }} </td>
                  <td> {{ $auditoria->expediente->folio }} </td>
                  <td> {{ $auditoria->tipoAudiencia->nombre }} </td>
                  <td> {{ $auditoria->sala->sala }} </td>
                  <td> {{ $auditoria->fechaCelebracion }} </td>
                  <td>
                      <a href=" {{ route('auditoria.lista.ver',  $auditoria->expediente->id) }} ">Ver</a>
                  </td>
              </tr>
            @endforeach        
        </tbody>
    </table>
  </div>  
</div>
@endsection
