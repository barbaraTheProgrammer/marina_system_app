@if ($place == null)
    There is no such place
@else
    Details of place

    place: {{ $place->place }}
    status: {{ $place->status }}

    <a href="places/{{ $place->id }}/edit"> edit place</a>
@endif
