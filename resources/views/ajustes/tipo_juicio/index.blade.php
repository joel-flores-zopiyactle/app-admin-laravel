@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Lista de juicios</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create.juicio') }}">Agregar nuevo juicio</a>
        </div>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    <x-alert-message />   
   
    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($juicios) > 0)
            <table class="table table-hover">
                <thead class="table-primary">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($juicios as $juicio)
                        <tr>
                            <td>{{ $juicio->nombre }}</td>
                            <td>{{ $juicio->descripcion }}</td>
                            <td>
                                @if ($juicio->estado)
                                    Disponible
                                @else
                                    No disponible
                                @endif

                            </td>
                            <td class="text-center d-flex justify-content-center">
                                <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.juicio', encrypt($juicio->id)) }}" title="Editar"> 
                                    <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                </a>

                                <form class="ml-2" action="{{route('delete.juicio', $juicio->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                    onclick="return confirm('¿Estas seguro de eliminar: {{$juicio->nombre}}?')">
                                        <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>     

            <div>
                {{ $juicios->links() }}  
            </div> 
        @else
            <div class="p-3">
                <h3>No hay tipos de justicia todabia</h3>
            </div>
        @endif
    </div>
</div>
@endsection
