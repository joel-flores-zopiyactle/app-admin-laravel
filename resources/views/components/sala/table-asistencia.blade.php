<div>
    <h3 class="h4 mt-4">Lista de asistentes</h3>
    <hr>

    <input type="number" value="{{ $audienciaid }}" id="expediente_id_lista" hidden>

    <div>
        {{-- Componente de vue --}}
        <tabla-asistencia />
    </div>

    {{-- 
        El siguiente codigo es funcioanl pero con platilla blade    
        para usar al que desscomentar y comentar el <tabla-asistencia />
    --}}
    
    {{-- <table class="table table-striped">
        <thead class="table-primary">
            <tr>
            <th scope="col"  style="width: 23%;">Nombre</th>
            <th scope="col"  style="width: 23%;">Rol</th>
            <th scope="col"  style="width: 23%;">Relación</th>
            <th scope="col"  style="width: 23%;">Asistencia</th>
            <th scope="col"  style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody id="lista-asistencia-tabla">

            @foreach ($participantes as $participante)
            <tr>
                <th scope="row">{{ $participante->nombre }}</th>
                <td>{{ $participante->rol->rol }}</td>
                <td>{{ $participante->descripcion }}</td>
                <td>@mdo</td>
            </tr>
            @endforeach    
        </tbody>
    </table> --}}
</div>
