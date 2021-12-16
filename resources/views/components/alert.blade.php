<div>
    @if (session('200'))
        <div class="alert alert-success">
            {{ session('200') }}
        </div>
    @elseif(session('400'))
        <div class="alert alert-warning">
            {{ session('400') }}
        </div>
    @elseif(session('500'))
        <div class="alert alert-danger">
            {{ session('500') }}
        </div>
    @else

    @endif
</div>