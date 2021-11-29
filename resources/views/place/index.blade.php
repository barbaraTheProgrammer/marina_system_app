<a href="places/create">create place</a>

places at marina
@forelse ($places as $place)
    <div>
        place: {{ $place->pier }}{{ $place->spot_nr }}
        status:
        @if ($place->status == '1')
            active
        @else
            inactive
        @endif
        <a href="places/{{ $place->id }}"> show place details </a>
        <a href="places/{{ $place->id }}/edit"> edit place</a>
    </div>
@empty
    No places in database
@endforelse