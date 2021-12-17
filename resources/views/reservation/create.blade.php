@extends('layouts.app')

@section('content')
    <h1 class="header">Create reservation</h1>

    <form action="{{ route('reservationStore', ['placeId' => $place->id, 'dateOfCome' => $dateOfCome, 'dateOfLeave' => $dateOfLeave]) }}" method="post">
        <span class="section-header">Place:</span>
        <div>
            <span>Place: {{ $place->pier }}{{ $place->spot_number }}</span>
        </div>

        <span class="section-header">When:</span>
        <div>
            <span>Date of come: {{ $dateOfCome }}</span>
        </div>
        <div>
            <span>Date of leave: {{ $dateOfLeave }}</span>
        </div>

        <span class="section-header">For which yacht:</span>
        <div>
            <label for="yachtName">Name:</label>
            <input type="text" name="yachtName" value="{{ $yacht->name ?? old("yachtName") }}">
            @error('yachtName')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="yachtLength">Length:</label>
            <input type="text" name="yachtLength" value="{{ $yacht->length ?? old("yachtLength")}}">
            <span class="info-message">*If length is not integer use dot (.) insted of comma (,) to write it down</span>  
            @error('yachtLength')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <span class="section-header">Who is the skipper:</span>
        <div>
            <label for="skipperName">Name:</label>
            <input type="text" name="skipperName" value="{{ $skipper->name ?? old("skipperName") }}">
            @error('skipperName')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="skipperSurname">Surname:</label>
            <input type="text" name="skipperSurname" value="{{ $skipper->surname ?? old("skipperSurname")}}">
            @error('skipperSurname')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="skipperEmail">Email:</label>
            <input type="text" name="skipperEmail" value="{{ $skipper->email ?? $skipperEmail ?? old("skipperEmail") }}">
            @error('skipperEmail')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        
        @csrf
        <button class="link-button">Make reservation</button>

    </form>
@endsection