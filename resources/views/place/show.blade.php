@extends('layouts.app')

@section('content')

@if ($place == null)
    There is no such place
@else
    Details of place

    pier: {{ $place->pier }}
    spot number: {{ $place->spot_number }}
    status:
        @if ($place->status == '1')
            active
        @else
            inactive
        @endif
    created by: {{ $placeCreatedBy }}
    created at: {{ $place->created_at }}

    <a href="{{ route('placeEdit', $place->id) }}"> edit place</a>

    <form action="{{ route('placeDestroy', $place->id) }}" method="post" onclick="return confirm('Are you sure?')">
        @method('DELETE')
        @csrf
        <button>delete</button>
    </form>
@endif

@endsection