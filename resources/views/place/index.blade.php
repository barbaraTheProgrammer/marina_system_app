@extends('layouts.app')

@section('content')

<h1 class="header">Places at marina</h1>
<p class="error-message">{{ request()->get('message') }}</p>

<div>
    <a class="link-button" href="{{ route('placeCreate') }}">create place</a>
</div>

<div class="listing-wrapper">
    <div class="places-listing header-element">
        <span>Place</span>
        <span>Status</span>
    </div>
    @forelse ($places as $place)
        <div class="listing places-listing">
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
