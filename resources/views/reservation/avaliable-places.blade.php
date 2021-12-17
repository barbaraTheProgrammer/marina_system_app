@extends('layouts.app')

@section('content')
    <h1 class="header">Avaliable places for reservation</h1>
    <h2>from  {{ $checkingDateOfCome }} to {{ $checkingDateOfLeave }}</h2>

    <div class="avaliable-places-listing">
        @forelse ($avaliablePlaces as $avaliablePlace)
            <div>
                <span>{{ $avaliablePlace->pier }}{{ $avaliablePlace->spot_number }}</span>
                <a href="{{ route('reservationCreate', ['place' => $avaliablePlace->id, 'dateOfCome' => $checkingDateOfCome, 'dateOfLeave' => $checkingDateOfLeave]) }}" class="button">make reservation</a>
            </div>
        @empty
            <h2 class="info-message">There are no free places in these days</h2>
        @endforelse
    </div>
    
@endsection