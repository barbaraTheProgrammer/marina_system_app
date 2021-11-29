<a href="places/create">create place</a>

places at marina
@forelse ($places as $place)
    <div>
        place: {{ $place->place }}
        status:
        @if ($place->status == '1')
            active
        @else
            inactive
        @endif
        <a href="places/{{ $place->id }}"> show place details </a>
    </div>
@empty
    No places in database
@endforelse