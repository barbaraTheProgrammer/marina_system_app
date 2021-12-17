@extends('layouts.app')

@section('content')
    @if ($reservation == null)
        <h1 class="header">Record doesn't exists</h1>
    @else
        <h1 class="header">Details of reservation</h1>
        
        <div class="details-wrapper">
            <div>
                <span class="detail-label">Place:</span>
                <a href="{{ route('placeShow', $reservation->place_id) }}">
                    @foreach ($places as $place)
                        @if ($place->id == $reservation->place_id)
                            {{ $place->pier }}{{ $place->spot_number }}
                        @endif
                    @endforeach
                </a>
            </div>
            <div>
                <span class="detail-label">Date of come:</span> {{ $reservation->date_of_come }}
            </div>
            <div>
                <span class="detail-label">Date of leave:</span> {{ $reservation->date_of_leave }}
            </div>
            <div>
                <span class="detail-label">Yacht name:</span> {{ $reservation->yacht_name }}
            </div>
            <div>
                <span class="detail-label">Yacht length:</span> {{ $reservation->yacht_length }}m
            </div>
            <div>
                <span class="detail-label">Skipper name:</span> {{ $reservation->skipper_name }}
            </div>
            <div>
                <span class="detail-label">Skipper surname:</span> {{ $reservation->skipper_surname }}
            </div>
            <div>
                <span class="detail-label">Skipper email:</span> {{ $reservation->skipper_email }}
            </div>
        </div>
    @endif

    <div class="active-reservation-button-wrapper">
        <a class="link-button" href="{{ route('trafficActivateReservation', $reservation->id) }}">activate reservation</a>
    </div>

    <div class="administration-information">
        <div>
            <span class="info-label">Created by:</span> {{ $recordCreatedBy->name }}
        </div>
        <div>
            <span class="info-label">Created at:</span> {{ $reservation->created_at }}
        </div>
        <div>
            <span class="info-label">Last update:</span> {{ $reservation->updated_at }} 
            <span class="info-label">by:</span> {{ $recordUpdatedBy->name }}
        </div>
    </div>
@endsection