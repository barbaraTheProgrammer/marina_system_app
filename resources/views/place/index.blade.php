@extends('layouts.app')

@section('content')

<h1>Places at marina</h1>

<a class="link-button" href="{{ route('placeCreate') }}">create place</a>

<div class="listing-wrapper">
    <div class="places-listing header-element">
        <span>Place</span>
        <span>Status</span>
    </div>
    @forelse ($places as $place)
        <div class="places-listing">
            <span>{{ $place->pier }}{{ $place->spot_number }}</span>
            <span>
                @if ($place->status == '1')
                    active
                @else
                    inactive
                @endif
            </span>
            <div>
                <a href="{{ route('placeShow', $place->id) }}">show details</a>
            </div>
        </div>
    @empty
        <h5 class="info-message">There are no "Places" in database</h5 class="info-message">
    @endforelse       
</div>

@endsection
