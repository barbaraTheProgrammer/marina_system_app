@extends('layouts.app')

@section('content')

<div class="marina-diagram">
    <h1 class="header">Marina diagram</h1>

    <div class="home-date-filter">
        <form action="{{ route('home') }}" method="get">
            <label class="filter-label" for="dateFilter">Pick day:</label>
            <input type="date" name="dateFilter" value={{ request()->dateFilter }}>

            <button class="button">show</button>
        </form>
        <a href="{{ route('home') }}" class="button today-button">today</a>
    </div>

    <div class="diagram-legend">
        <div class="item">
            <div class="color default"></div>
            <span class="legend-label">free</span>
        </div>
        <div class="item">
            <div class="color busy"></div>
            <span class="legend-label">busy</span>
        </div>
        <div class="item">
            <div class="color reservated"></div>
            <span class="legend-label">reservated</span>
        </div>
        <div class="item">
            <div class="color inactive"></div>
            <span class="legend-label">inactive</span>
        </div>
    </div>

    @forelse ($piers as $singlePier)
        <div class="pier-label-wrapper"><span class="pier-label">PIER {{ $singlePier->pier }}</span></div>
        <div class="single-pier">
            @foreach ($places as $place)
                @if ($place->pier == $singlePier->pier)
                    @if ($place->status == 0)
                        <div class="place-tile inactive">
                            <a href="{{ route('placeShow', $place->id) }}">
                                {{ $place->pier }}{{ $place->spot_number }}
                            </a>
                        </div>
                    @elseif (isset($traffic) && array_search($place->id, array_column($traffic, 'place_id')) !== false)
                        @foreach ($traffic as $trafficRecord)
                            @if ($trafficRecord->place_id == $place->id)
                                <div class="place-tile busy">
                                    <a href="{{ route('trafficShow', $trafficRecord->id) }}">
                                        {{ $place->pier }}{{ $place->spot_number }}
                                    </a>
                                </div>
                                @continue
                            @endif
                        @endforeach
                    @elseif (isset($reservations) && array_search($place->id, array_column($reservations, 'place_id')) !== false)
                        @foreach ($reservations as $reservation)
                            @if ($reservation->place_id == $place->id)
                                <div class="place-tile reservated">
                                    <a href="{{ route('reservationShow', $reservation->id) }}">
                                        {{ $place->pier }}{{ $place->spot_number }}
                                    </a>
                                </div>
                                @continue
                            @endif
                        @endforeach
                    @else
                        <div class="place-tile default">
                            <a href="{{ route('placeShow', $place->id) }}">
                                {{ $place->pier }}{{ $place->spot_number }}
                            </a>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    @empty
        <h2>No places in marina system yet</h2>
    @endforelse
    

    
</div>


@endsection
