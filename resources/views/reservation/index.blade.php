@extends('layouts.app')

@section('content')
    <h1>Reservations</h1>

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
        <div class="reservation-listing">

        </div>
    </div>
@endsection