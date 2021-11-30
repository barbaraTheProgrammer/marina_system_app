@if ($place == null)
    There is no such place
@else
    Details of place

    pier: {{ $place->pier }}
    spot number: {{ $place->spot_nr }}
    status: {{ $place->status }}

    <a href="{{ route('placeEdit', $place->id) }}"> edit place</a>

    <form action="{{ route('placeDestroy', $place->id) }}" method="post" onclick="return confirm('Are you sure?')">
        @method('DELETE')
        @csrf
        <button>delete</button>
    </form>
@endif
