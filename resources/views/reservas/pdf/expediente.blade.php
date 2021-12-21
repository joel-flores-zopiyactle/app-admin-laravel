<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   {{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
   <style>
       * {
           padding: 0;
           margin: 0;
           box-sizing: border-box;
           font-family: sans-serif;
           font-size: 14px;
       }

      
       /* spacing */
       header {
            width: 100%;
            height: 30px;
            background: rgb(90, 99, 181);
            padding: 10px;   
       }

       h1 {
           margin-top: 15px;
           font-size: 25px;
           margin-bottom: 10px;
       }

       .container {
           width: 100%;
           max-width: 95%;
           margin: auto;
       }

       .content {
           margin: auto;
           padding: 10px;
           margin-top: 20px;
           margin-bottom: 10px;
           background: rgb(90, 99, 181);
           color: #fff;
           text-align: center;
           text-transform: capitalize;
       }

       table {
        margin-top: 20px;
        width: 100%;
       }

       table > thead {
        background: rgb(90, 99, 181);
        color: #fff;
        text-align: center;
       }

       table > thead > tr > td {
           padding: 10px;
       }

       table > tbody {
           text-align: center;
       }

       table > tbody > tr > td {
           padding: 10px;
       }

        table, th {
            /* border: 1px solid rgb(104, 104, 104); */
        }
   </style>
</head>
<body>
   
    <div>
        
        <header>
            <img src="" alt="">
        </header>

        <div class="container">
        
            <h1>Reservación de la sala</h1>

            <div class="content">
                <h2>Datos generales del Expediente</h2>
            </div>

            <table style="width:50%">
                <thead>
                    <tr>
                        <td style="width: 50%">Numero de expediente:</td>
                        <td style="width: 50%">Folio:</td>
                    
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="width: 50%">{{ $expediente->id }}</td>
                        <td style="width: 50%">{{ $expediente->folio }}</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                <tr>
                    <td style="width: 25%">Juez</td>
                    <td style="width: 25%">Juzgado</td>
                    <td style="width: 25%">Actor</td>
                    <td style="width: 25%">Secretario</td>
                    <td style="width: 25%">Demandado</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 25%">{{ $expediente->juez }}</td>
                        <td style="width: 25%">{{ $expediente->juzgado }}</td>
                        <td style="width: 25%">{{ $expediente->actor }}</td>
                        <td style="width: 25%">{{ $expediente->secretario }}</td>
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
                <h2>Lista de Participantes</h2>
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
                <section style="text-align: center;">
                    No hay participantes en la audiencia
                </section>
            @endif

            {{-- Toekn --}}

            <table>
                <thead>
                <tr>
                    <td>Token de acceso:</td>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $expediente->token->token }}</td>
                    
                    </tr>
                </tbody>
            </table>

        </div>

       

    </div>

    {{-- {{ $expediente->tipoJuicio }} --}}
</body>
</html>