@extends('layouts.dashboard')

@section('title')
    Resultado de la busqueda
@endsection

@section('content')
<div class="container">
    <div>
        <h5>Resultado de la busqueda</h5>
        <hr>
    </div>

    <div class=" bg-white p-3 shadow rounded">       
        @if ($audiencia)
            @isset($audiencia)
            <table class="table table-responsive table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <td>Núm. Expediente</td>
                        <td>Folio</td>
                        <td>Tipo de audiencia</td>
                        <td>Sala</td>
                        <td>Fecha celebración</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> {{ $audiencia->expediente->numero_expediente }} </td>
                        <td> {{ $audiencia->expediente->folio }} </td>
                        <td> {{ $audiencia->tipoAudiencia->nombre }} </td>
                        <td> {{ $audiencia->sala->sala }} </td>
                        <td> {{ $audiencia->fechaCelebracion }} </td>
                        <td>
                            <a href=" {{ route('auditoria.lista.ver', encrypt($audiencia->expediente->id)) }} ">Ver</a>
                        </td>
                    </tr>   
                </tbody>
            </table> 
            @endisset 
        @else
            <div class="d-flex justify-content-center align-items-center">
                <h3 class="fs-5">No se encontro ningún resultado de la busqueda...</h3>
            </div>
        @endif 
    </div>  
</div>
@endsection
