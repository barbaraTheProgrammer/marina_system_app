@extends('layouts.app')

@section('content')

<a href="{{ route('placeCreate') }}">create place</a>

places at marina
@forelse ($places as $place)
    <div>
        place: {{ $place->pier }}{{ $place->spot_number }}
        status:
        @if ($place->status == '1')
            active
        @else
            inactive
        @endif

        <a href="{{ route('placeShow', $place->id) }}">show details</a>

    </div>
@empty
    No places in database
@endforelse

@endsection
