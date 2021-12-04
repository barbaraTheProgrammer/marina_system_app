@extends('layouts.app')

@section('content')
    <h1>Traffic in marina</h1>

    <form action="{{ route('trafficCheckIfExists') }}" method="post">
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

    tutaj bedzie lista aktualna
@endsection