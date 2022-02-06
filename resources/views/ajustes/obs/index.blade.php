@extends('layouts.dashboard')

@section('title')
Configuración de IP
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Configuración de IP para conectarse a OBS externo</h4>
       
    </div>

    <hr>

    <x-alert-message />

   {{-- Lista de datos  --}}
    <div class="shadow p-4 mb-5 bg-body rounded card">
        <label for="ip">Dirección IP</label>
        <form class="w-50 d-flex align-content-end align-items-lg-start" action="{{  isset($config) ? route('config.obs.update', $config->id) : route('config.obs.post') }}" method="post">
            @csrf
            @isset($config)
                @method('PUT')
            @endisset

            <div class="me-1">
                <input type="text" class="form-control me-1  @error('ip') is-invalid @enderror" placeholder="Ejemplo: 192.168.0.1" name="ip" id="ip" value="{{ isset($config) ? $config->ip : old('ip') }}"  required> {{-- pattern="^((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)$" --}}
                @error('ip')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary ml-1">{{ isset($config) ? 'Actualizar' : 'Registrar'}}</button>
        </form>

    </div>
</div>
@endsection
