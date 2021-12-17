@extends('layouts.app')

@section('content')
    <h1 class="header">Reservations</h1>

    <form action="{{ route('reservationCheckAvaliablePlaces') }}" method="post">
        <div>
            <label for="dateOfCome">Date of come:</label>
            <input type="date" name="dateOfCome" value="{{ old("dateOfCome") }}">
            @error('dateOfCome')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="dateOfLeave">Date of leave:</label>
            <input type="date" name="dateOfLeave" value="{{ old("dateOfLeave") }}">
            @error('dateOfLeave')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <button class="link-button">check avaliable places</button>
        </div>
    
        @csrf
    </form>

    <div class="listing-wrapper">
        <div class="reservation-listing header-element">
            <span>Place</span>
            <span>Come</span>
            <span>Leave</span>
            <span>Yacht</span>
            <span>Y. Length [m]</span>
            <span>Skipper surname</span>
        </div>
        @forelse ($reservations as $reservation)
            <div class="listing reservation-listing">
                <div>
                    <a href="{{ route('placeShow', $reservation->place_id) }}">
                        @foreach ($places as $place)
                            @if ($place->id == $reservation->place_id)
                                {{ $place->pier }}{{ $place->spot_number }}
                            @endif
                        @endforeach
                    </a>
                </div>
                <div>{{ $reservation->date_of_come }}</div>
                <div>{{ $reservation->date_of_leave }}</div>
                <div>{{ $reservation->yacht_name }}</div>
                <div>{{ $reservation->yacht_length }}</div>
                <div>{{ $reservation->skipper_surname }}</div>
                <div>
                    <a href="{{ route('reservationShow', $reservation->id) }}">show details</a>
                </div>
            </div>
        @empty
            <h5 class="info-message">There are no records in database</h5 class="info-message">
        @endforelse       
    </div>
@endsection