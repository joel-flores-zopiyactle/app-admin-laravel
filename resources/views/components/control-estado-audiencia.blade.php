<div>
    @if ($estadoAudiencia->estado === 'Agendada')
        <span class="badge px-3" style="background: {{$estadoAudiencia->color}}"> {{ $estadoAudiencia->estado }} </span>

    @elseif ($estadoAudiencia->estado === 'Reagendada')
        <span class="badge px-3" style="background: {{$estadoAudiencia->color}}"> {{ $estadoAudiencia->estado }} </span>

    @elseif ($estadoAudiencia->estado === 'Celebrándose')
        <span class="badge px-3" style="background: {{$estadoAudiencia->color}}"> {{ $estadoAudiencia->estado }} </span>

    @elseif ($estadoAudiencia->estado === 'Pausada')
        <span class="badge px-3" style="background: {{$estadoAudiencia->color}}"> {{ $estadoAudiencia->estado }} </span>
    @elseif ($estadoAudiencia->estado === 'Cancelada')
        <span class="badge px-3" style="background: {{$estadoAudiencia->color}}"> {{ $estadoAudiencia->estado }} </span>

    @elseif ($estadoAudiencia->estado === 'Finalizada')
        <span class="badge px-3" style="background: {{$estadoAudiencia->color}}"> {{ $estadoAudiencia->estado }} </span>
    @else
        I don't have any status!
    @endif
</div>