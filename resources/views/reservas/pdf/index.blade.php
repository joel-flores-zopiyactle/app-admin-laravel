@extends('layouts.dashboard')

@section('title')
    Sala reservada
@endsection

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center">
    
    <div class="text-center mt-5">
        <h2>Sala reservada exitosamente</h2>


        <a href="{{ route('show.pdf.expediente', $id) }}" class="btn btn-outline-primary mt-3">Descargar expediente PDF</a>
    </div>

   
</div>
@endsection

@section('js')
    <script src="{{ asset('js/filtroBusqueda.js') }}"></script>
@endsection
