
@extends('layouts.dashboard')

@section('title')
    Análisis estadístico
@endsection

@section('content')
<div class="container">
   
    <div class="row">
        <div class="col-4">
            <div class="bg-white shadow p-3 rounded">
            
                <h5>
                    <span class="iconify h4" data-icon="uil:calender"></span>
                    Total de Audiencias celebradas
                </h5>
                <hr>

                <div>
                    {{ $totalCelebradas }}
                </div>



            </div>
        </div>
        <div class="col-4">
            <div class="bg-white shadow p-3 rounded">
                <h5>
                    <span class="iconify h4" data-icon="uil:calender"></span>
                    Total de audiencias reservadas
                </h5>
                <hr>

                <div>
                    {{ $totalReservadas }}
                </div>
        
            </div>
           
        </div>
        <div class="col-4">
           <div class="bg-white shadow p-3 rounded">
                <h5>
                    <span class="iconify h4" data-icon="uil:calender"></span>
                    Total de audiencias canceladas
                </h5>
                <hr>

                <div>
                    {{ $totalCanceladas }}
                </div>
           </div>
    
            
        </div>
    </div>

    <div class="row mt-3">
        @if (count($audienciaMayorDuracion) > 0)
            <div class="col-4">
                <div class="bg-white shadow p-3 rounded">
                    <h5>
                        <span class="iconify h4" data-icon="bi:clock"></span>
                        Audiencia con mayor duración
                    </h5>
                    <hr>
    
                    <div>
                        <p>Expediente numero: {{ $audienciaMayorDuracion['numero_expediente'] }} </p>
                        Tiempo de grabación:  {{ $audienciaMayorDuracion['duracion'] }}
                    </div>
                </div>             
            </div>
        @endif
    </div>

    <div class="row mt-5 bg-white shadow rounded" style="height: 550px;">
        <div class="p-3">
            <h5>Análisis de audiencias celebradas en este periodo. </h5>
            <hr>
        </div>
        <chart-bar-adiencias-celebradas />
    </div>

    <div class="row mt-5 bg-white shadow rounded" style="height: 550px;">
        <div class="p-3">
            <h5>Total de videoconferencias celebradas. </h5>
            <hr>
        </div>
        <chart-videoconferencia-total />
    </div>

    <div class="row mt-5 bg-white shadow rounded" style="height: 550px;">
        <div class="p-3">
            <h5>Total de MB consumidos. </h5>
            <hr>
        </div>
        <chart-disk-consumo-mb />
    </div>

    
</div>
@endsection
