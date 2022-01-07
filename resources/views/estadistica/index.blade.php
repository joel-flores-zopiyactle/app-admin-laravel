
@extends('layouts.dashboard')

@section('title')
    Estadistica
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
        <div class="col-4">
            <div class="bg-white shadow p-3 rounded">
                 <h5>
                    <span class="iconify h4" data-icon="bi:clock"></span>
                     Audiencia con mayor duración
                 </h5>
                 <hr>
 
                 <div>
                    <p>Audiencia numero: </p>
                    Tiempo de grabación:  {{ $audienciaMayorDuracion }}
                 </div>
            </div>             
        </div>
    </div>

    <div class="row mt-5 bg-white shadow rounded" style="height: 450px;">
        <chart-bar-adiencias-celebradas />
    </div>
</div>
@endsection
