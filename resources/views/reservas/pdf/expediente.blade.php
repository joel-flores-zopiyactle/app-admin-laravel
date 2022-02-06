<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expediente número -{{ $expediente->numero_expediente }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">

   {{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
   <style>
       * {
           padding: 0;
           margin: 0;
           box-sizing: border-box;
         font-family: 'Roboto', sans-serif;
           font-size: 12px;
       }

      
       /* spacing */
       header {
            width: 100%;
            height: 10px;
            background: #c4c4c4;
            padding: 10px;   
       }

       .container {
           width: 100%;
           max-width: 95%;
           margin: auto;
           margin-top: 20px;
       }

       .banner {
           text-align: center;
           width: 100%;
           max-width: 60%;
           margin: auto;
           margin-top: 50px;
           padding-bottom: 45px;
       }

       .banner > h1 {
           font-size: 20px;
           border-bottom:  1px solid #696767;

       }

       .banner > section {
           margin-bottom: 15px;
           margin-top:5px;
           font-size: 16px; 
       }

       .banner > section > b {
        font-size: 14px; 
        display: flex;
        flex-wrap: wrap;
       }

       .content {
           margin: auto;
           padding: 10px;
           margin-top: 20px;
           padding-bottom: 10px;
           font-weight: 500;
          /*  background: #9f8e86;
           color: #fff; */
           text-align: center;
           /* text-transform: capitalize; */
           border-bottom:  1px solid #696767;
       }

       .content > h3 {
        font-size: 16px;
       }

       table {
        width: 100%;
        font-size: 18px;
        margin-bottom: 10px;
       }

       table > thead {
        background: #726660;
        color: #fff;
        text-align: center;
       }

       table > thead > tr > td {
           padding: 8px;
       }

       table > tbody {
           text-align: center;
       }

       table > tbody > tr > td {
           padding: 10px;
       }

        table, th {
            /* border: 1px solid #9a8882; */
        }
   </style>
</head>
<body>
   
    <div>
        
        <header>
            <img src="" alt="">
        </header>

        <div class="container">
        
           <div class="banner">
                <h1>Reservación de la audiencia</h1>
                
                <section>
                   <p><b> Centro de justicia</b> : {{$expediente->audiencia->centroJusticia->nombre}}</p>
                   <p><b> Sala</b>: {{  $expediente->audiencia->sala->sala}}</p>
                   <p><b> Agendada</b>: {{ \Carbon\Carbon::parse($expediente->created_at)->format('d/m/Y')}}</p>
                </section>
           </div>

            <div class="content">
                <h3>Datos generales del expediente</h3>
               
            </div>

            <table style="width:50%">
                <thead>
                    <tr>
                        <td style="width: 50%">Número de expediente</td>
                        <td style="width: 50%">Folio</td>
                    
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="width: 50%">{{ $expediente->numero_expediente }}</td>
                        <td style="width: 50%">{{ $expediente->folio }}</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                <tr>
                    <td style="width: 25%">Juez</td>
                    <td style="width: 25%">Secretario</td>
                    <td style="width: 25%">Testigo</td>
                    <td style="width: 25%">Parte Actora</td>
                    <td style="width: 25%">Parte Demandada</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 25%">{{ $expediente->juez }}</td>
                        <td style="width: 25%">{{ $expediente->secretario }}</td>
                        <td style="width: 25%">{{ $expediente->juzgado }}</td>
                        <td style="width: 25%">{{ $expediente->actor }}</td>
                        <td style="width: 25%">{{ $expediente->demandado }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Lista de seleccion --}}
            <table>
                <thead>
                <tr>
                    <td style="width: 25%">Centro de justicia</td>
                    <td style="width: 25%">Sala</td>
                    <td style="width: 25%">Tipo de audiencia</td>
                    <td style="width: 25%">Tipo de Juicio</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                    {{--  <td>{{ $expediente->audiencia }}</td> --}}
                        <td style="width: 25%">{{ $expediente->audiencia->centroJusticia->nombre }}</td>
                        <td style="width: 25%">{{ $expediente->audiencia->sala->sala }}</td>
                        <td style="width: 25%">{{ $expediente->audiencia->tipoAudiencia->nombre }}</td>
                        <td style="width: 25%">{{ $expediente->tipoJuicio->nombre }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Tiempos --}}
            <table>
                <thead>
                <tr>
                    <td style="width: 33%">Fecha de Celebración</td>
                    <td style="width: 33%">Hora de Inicio</td>
                    <td style="width: 33%">Hora a Finalizar</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 33%">{{ $expediente->audiencia->fechaCelebracion }}</td>
                        <td style="width: 33%">{{ $expediente->audiencia->horaFinalizar }}</td>
                        <td style="width: 33%">{{ $expediente->audiencia->horaInicio }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="content">
                <h3>Lista de participantes</h3>
            </div>

            @if (count(($expediente->audiencia->participantes)) > 0)
                <table>
                    <thead>
                        <tr>
                            <td style="width: 50%">Nombre </td>
                            <td style="width: 50%">Rol</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expediente->audiencia->participantes as $participante)
                            <tr>
                                <td style="width: 50%">{{ $participante->nombre }}</td>
                                <td style="width: 50%">{{ $participante->rol->rol }}</td>
                            </tr>
                        @endforeach                 
                    </tbody>
                </table>
            @else
                <section style="text-align: center; padding-bottom: 25px;">
                    No hay participantes en la audiencia
                </section>
            @endif

            {{-- Toekn --}}

            <table>
                <thead>
                <tr>
                    <td>Token de acceso</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $expediente->token->token }}</td>
                    
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                <tr>
                    <td>Token de invitado</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $expediente->tokenInvitado->token ?? 'No hay token'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

       

    </div>

    {{-- {{ $expediente->tipoJuicio }} --}}
</body>
</html>