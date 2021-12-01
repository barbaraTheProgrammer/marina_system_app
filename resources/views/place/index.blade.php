@extends('layouts.app')

@section('content')

<h1>Places at marina</h1>

<a class="link-button" href="{{ route('placeCreate') }}">create place</a>

<div class="listing-wrapper">
    @if ($places != null)
        <div class="listing-element header-element">
            <span>Place</span>
            <span>Status</span>
        </div>
        @foreach ($places as $place)
            <div class="listing-element">
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
        @endforeach        
    @else
        <h2>There are no "Places" in database</h2>
    @endif
</div>

@endsection
