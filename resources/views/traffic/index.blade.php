@extends('layouts.app')

@section('content')
    <h1 class="header">Traffic in marina</h1>

    <form action="{{ route('trafficCreate') }}" method="get">
        <div>
            <label for="registrationNumber">Registration number:</label>
            <input type="text" name="registrationNumber" value="{{ old("registrationNumber") }}">
            @error('registrationNumber')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="skipperEmail">Skipper email:</label>
            <input type="text" name="skipperEmail" value="{{ old("skipperEmail") }}">
            @error('skipperEmail')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <button class="link-button">new coming</button>
        </div>
    
        @csrf
    </form>

    <div class="traffic-listing-header-wrapper">
        <h3 class="traffic-section-header">Current state</h3>
        <a href="{{ route('trafficShowHistory', ['filter' => 'all']) }}" class="button">show history</a>
    </div>

    <div class="listing-wrapper">
        <div class="traffic-listing header-element">
            <span>Place</span>
            <span>Yacht</span>
            <span>Coming</span>
            <span>Leaving</span>
        </div>
        @forelse ($traffic as $trafficRecord)
            <div class="listing traffic-listing">
                <div>
                    <a href="{{ route('placeShow', $trafficRecord->place_id) }}">
                        @foreach ($places as $place)
                            @if ($place->id == $trafficRecord->place_id)
                                {{ $place->pier }}{{ $place->spot_number }}
                            @endif
                        @endforeach
                    </a>
                </div>
                <div>
                    <a href="{{ route('yachtShow', $trafficRecord->yacht_id) }}">
                        @foreach ($yachts as $yacht)
                            @if ($yacht->id == $trafficRecord->yacht_id)
                                {{ $yacht->name }}
                            @endif
                        @endforeach
                    </a>
                </div>
                <span>{{ $trafficRecord->date_of_come }}</span>
                <span>{{ $trafficRecord->date_of_leave }}</span>
                <div>
                    <a href="{{ route('trafficShow', $trafficRecord->id) }}">show details</a>
                </div>
            </div>
        @empty
            <h5 class="info-message">There are no reacords in database</h5 class="info-message">
        @endforelse   
    </div>

@endsection