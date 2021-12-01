@extends('layouts.app')

@section('content')
    <h1>New coming</h1>

    <form action="{{ route('trafficStore') }}" method="post">
        <span class="section-header">About marina:</span>
        <div>
            <label for="pier">Pier:</label>
            <input type="text" name="pier" value="{{ old("pier") }}">
            @error('pier')
            <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
        <div>
            <label for="spotNumber">Spot number:</label>
            <input type="number" name="spotNumber" value="{{ old("spotNumber") }}">
            @error('spotNumber')
            <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>
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

        <form action="#" method="post">
            <span class="section-header">About yacht:</span>

            <form action="{{ route('yachtCheckIfExists') }}" method="post">
                <div>
                    <label for="registrationNumber">Registration number:</label>
                    <input type="text" name="registrationNumber" value="{{ old("registrationNumber") }}">
                    @error('registrationNumber')
                        <div class="error-message"> {{ $message }} </div>
                    @enderror
                </div>
                <div>
                    <button class="link-button">check if exists</button>
                    <p class="info-message">*if yacht already exists in database, rest of the form will fill automatically</p>
                </div>
            </form>
            
            <div>
                <label for="yachtName">Name:</label>
                <input type="text" name="yachtName" value="{{ old("yachtName") }}">
                @error('yachtName')
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
                <label for="yachtOwner">Owner:</label>
                <input type="text" name="yachtOwner" value="{{ old("yachtOwner") }}">
                @error('yachtOwner')
                    <div class="error-message"> {{ $message }} </div>
                @enderror
            </div>
        </form>

        @csrf

        <button class="link-button">save</button>
    </form>
@endsection