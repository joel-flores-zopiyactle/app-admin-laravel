<div>
    <h3 class="h5">Listta de asistencia</h3>
    <hr>

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Rol</th>
            <th scope="col">Relación</th>
            <th scope="col">Asistencia</th>
            </tr>
        </thead>
        <tbody id="lista-asistencia">

            @foreach ($participantes as $participante)
            <tr>
                <th scope="row">{{ $participante->nombre }}</th>
                <td>{{ $participante->rol->rol }}</td>
                <td>{{ $participante->descripcion }}</td>
                <td>@mdo</td>
            </tr>
            @endforeach
        
        </tbody>
        </table>
</div>