
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

    <div class="row mt-5 bg-white rounded shadow">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
  
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviemnre', 'Diciembre'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endsection
