@extends('layouts.app')

@section('content')
    <h1 class="header">New coming</h1>

    <form action="{{ route('trafficStore', ['reservationId' => $reservation->id]) }}" method="post">

        <span class="section-header">About marina:</span>

        <div>
            <label for="place">Place:</label>
            <input type="text" value="{{ $reservatedPlace ?? old("place") }}" readonly>
            <input type="hidden" name="place" value="{{ $reservation->place_id}}" readonly>
            @error('place')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="dateOfCome">Date of come:</label>
            <input type="date" name="dateOfCome" value="{{ $reservation->date_of_come ?? old("dateOfCome") }}" readonly>
            @error('dateOfCome')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="dateOfLeave">Date of leave:</label>
            <input type="date" name="dateOfLeave" value="{{ $reservation->date_of_leave ?? old("dateOfLeave") }}" readonly>
            @error('dateOfLeave')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>


        <span class="section-header">About yacht:</span>
        
        <div>
            <label for="yachtName">Name:</label>
            <input type="text" name="yachtName" value="{{ $reservation->yacht_name ?? old("yachtName") }}" readonly>
            @error('yachtName')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="yachtRegistrationNumber">Registration number:</label>
            <input type="text" name="yachtRegistrationNumber" value="{{ old("yachtRegistrationNumber") }}">          
            @error('yachtRegistrationNumber')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="yachtType">Type:</label>
            <input type="text" name="yachtType" value="{{ old("yachtType") }}">       
            @error('yachtType')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="yachtLength">Length:</label>
            <input type="text" name="yachtLength" value="{{ $reservation->yacht_length ?? old("yachtLength")}}" readonly>       
            @error('yachtLength')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="yachtOwner">Owner:</label>
            <input type="text" name="yachtOwner" value="{{ old("yachtOwner") }}">  
            @error('yachtOwner')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>


        <span class="section-header">About skipper:</span>
        
        <div>
            <label for="skipperName">Name:</label>
            <input type="text" name="skipperName" value="{{ $reservation->skipper_name ?? old("skipperName") }}" readonly>
            @error('skipperName')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="skipperSurname">Surname:</label>
            <input type="text" name="skipperSurname" value="{{ $reservation->skipper_surname ?? old("skipperSurname")}}" readonly>
            @error('skipperSurname')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="skipperPersonalIdNumber">Personal ID number:</label>
            <input type="text" name="skipperPersonalIdNumber" value="{{ old("skipperPersonalIdNumber") }}">
            @error('skipperPersonalIdNumber')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="skipperCountry">Country:</label>
            <input type="text" name="skipperCountry" value="{{ old("skipperCountry") }}">
            @error('skipperCountry')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="skipperEmail">Email:</label>
            <input type="text" name="skipperEmail" value="{{ $reservation->skipper_email ?? old("skipperEmail") }}" readonly>
            @error('skipperEmail')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        @csrf

        <button class="link-button">save</button>
    </form>
@endsection