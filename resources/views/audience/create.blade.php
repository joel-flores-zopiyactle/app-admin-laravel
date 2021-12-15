@extends('layouts.dashboard')

@section('content')
<div>
    <h2>Nueva auduencia</h2>
    <hr>

    <form>
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="expediente" class="form-label">Expediente</label>
                    <input type="text" class="form-control" id="expediente" aria-describedby="expedienteHelp">
                    <div id="expedienteHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="numExpediente" class="form-label">Numero de Expediente</label>
                    <input type="number" class="form-control" id="numExpediente" aria-describedby="numExpedienteHelp">
                    <div id="numExpedienteHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-6">
                <div class="mb-3">
                    <label for="juez" class="form-label">Juez</label>
                    <input type="text" class="form-control" id="juez" aria-describedby="juezHelp">
                    <div id="juezHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="actor" class="form-label">Actor</label>
                    <input type="text" class="form-control" id="actor" aria-describedby="actorHelp">
                    <div id="actorHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

        </div>

        <div class="row">
            
            <div class="col-4">
                <div class="mb-3">
                    <label for="demandado" class="form-label">Demandado</label>
                    <input type="text" class="form-control" id="demandado" aria-describedby="demandadoHelp">
                    <div id="demandadoHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="centroJusticia" class="form-label">Centro de justicia</label>
                    <input type="text" class="form-control" id="centroJusticia" aria-describedby="centroJusticiaHelp">
                    <div id="centroJusticiaHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="sala" class="form-label">Sala</label>
                    <input type="text" class="form-control" id="sala" aria-describedby="salaHelp">
                    <div id="salaHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

        </div>
        
        <div class="row">

            <div class="col-3">
                <div class="mb-3">
                    <label for="audiencia" class="form-label">Tipo de audiencia</label>
                    <input type="text" class="form-control" id="audiencia" aria-describedby="audiencia">
                    <div id="audiencia" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" aria-describedby="fecha">
                    <div id="fecha" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="horaInicio" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" id="horaInicio" aria-describedby="horaInicio">
                    <div id="horaInicio" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="horaFinal" class="form-label">Hora de final</label>
                    <input type="time" class="form-control" id="horaFinal" aria-describedby="horaFinal">
                    <div id="horaFinal" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>
        </div>

        <hr>

        <div class="mb-5 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Crear nueva audiencia</button>
        </div>
    </form>
</div>
@endsection