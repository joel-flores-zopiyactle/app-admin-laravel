@extends('layouts.dashboard')

@section('title')
    Lista de Auditorias
@endsection

@section('content')
<div class="container">
    <div>
        <h5>Listado de audiencias celebradas</h5>
        <hr>
    </div>

    <x-alert-message/>
    
    <div class=" bg-white p-3 shadow rounded">
    @if (count($auditorias) > 0)

        <form action="{{ route('auditoria.lista.buscar') }}" class="mb-2 w-50" method="GET">
            <div class="d-flex">
                <input type="search" class="form-control me-1" name="buscar" id="buscar" placeholder="Ingresar número de audiencia">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <hr>
        
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
                @foreach ($auditorias as $auditoria)
                    <tr>
                        <td> {{ $auditoria->expediente->numero_expediente }} </td>
                        <td> {{ $auditoria->expediente->folio }} </td>
                        <td> {{ $auditoria->tipoAudiencia->nombre }} </td>
                        <td> {{ $auditoria->sala->sala }} </td>
                        <td> {{ $auditoria->fechaCelebracion }} </td>
                        <td>
                            <a href=" {{ route('auditoria.lista.ver', encrypt($auditoria->expediente->id)) }} ">Ver</a>
                        </td>
                    </tr>
                @endforeach        
            </tbody>
        </table>

        <div class="mt-1">
            {{ $auditorias->links() }}
        </div>
    @else

    <div class="d-flex justify-content-center align-items-center">
        <h3 class="fs-5">No hay audiencias celebradas todavía</h3>
    </div>

    @endif
   
    </div>  
</div>
@endsection
