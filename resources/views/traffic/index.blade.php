@extends('layouts.app')

@section('content')
    <h1>Traffic in marina</h1>

    <form action="{{ route('trafficCreate') }}" method="post">
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

    <div class="listing-wrapper">
        @if ($traffic != null)
            <div class="traffic-listing header-element">
                <span>Place</span>
                <span>Yacht</span>
                <span>Coming</span>
                <span>Leaving</span>
            </div>
            @foreach ($traffic as $trafficRecord)
            <div class="traffic-listing">
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
        @endforeach     
        @else
            <h2>There are no reacords in database</h2>
        @endif
    </div>

@endsection