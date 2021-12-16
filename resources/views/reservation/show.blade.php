@extends('layouts.app')

@section('content')
    @if ($reservation == null)
        <h1>Record doesn't exists</h1>
    @else
        <h1>Details of reservation</h1>
        
        <div class="details-wrapper">
            <div>
                <span>Place:</span>
                <a href="{{ route('placeShow', $reservation->place_id) }}">
                    @foreach ($places as $place)
                        @if ($place->id == $reservation->place_id)
                            {{ $place->pier }}{{ $place->spot_number }}
                        @endif
                    @endforeach
                </a>
            </div>
            <div>
                <span>Date of come: {{ $reservation->date_of_come }}</span>
            </div>
            <div>
                <span>Date of leave: {{ $reservation->date_of_leave }}</span>
            </div>
            <div>
                <span>Yacht name: {{ $reservation->yacht_name }}</span>
            </div>
            <div>
                <span>Yacht length: {{ $reservation->yacht_length }}m</span>
            </div>
            <div>
                <span>Skipper name: {{ $reservation->skipper_name }}</span>
            </div>
            <div>
                <span>Skipper surname: {{ $reservation->skipper_surname }}</span>
            </div>
            <div>
                <span>Skipper email: {{ $reservation->skipper_email }}</span>
            </div>
            <div>
                <span>Created by: {{ $recordCreatedBy->name }}</span>
            </div>
            <div>
                <span>Created at: {{ $reservation->created_at }}</span>
            </div>
            <div>
                <span>Last update: {{ $reservation->updated_at }} by: {{ $recordUpdatedBy->name }}</span>
            </div>
        </div>
    @endif

    <div>
        <a class="link-button" href="{{ route('trafficActivateReservation', $reservation->id) }}">activate reservation</a>
    </div>
@endsection