@extends('layouts.app')

@section('content')
    <h1 class="header">New coming</h1>

    <form action="{{ route('trafficStore') }}" method="post">

        <span class="section-header">About marina:</span>

        <div>
            <label for="place">Place:</label>
            <select name="place">
                <option value=""> -- Select place -- </option>
                @foreach ($avaliablePlaces as $place)
                    @if (old('place') == $place->id)
                        <option selected="selected" value="{{ $place->id}}">{{ $place->pier }}{{ $place->spot_number }}</option>
                    @else
                        <option value="{{ $place->id}}">{{ $place->pier }}{{ $place->spot_number }}</option>
                    @endif    
                @endforeach
            </select>
            @error('place')
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


        <span class="section-header">About yacht:</span>
        @isset($yacht)
            <span class="info-message">Yacht already exists in database</span>
        @endisset
        
        <div>
            <label for="yachtName">Name:</label>
            <input type="text" name="yachtName" value="{{ $yacht->name ?? old("yachtName") }}">
            @error('yachtName')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="yachtRegistrationNumber">Registration number:</label>
            <input type="text" name="yachtRegistrationNumber" value="{{ $yacht->registration_number ?? $registrationNumber ?? old("yachtRegistrationNumber") }}">          
            @error('yachtRegistrationNumber')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="yachtType">Type:</label>
            <input type="text" name="yachtType" value="{{ $yacht->type ?? old("yachtType") }}">       
            @error('yachtType')
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

        <div>
            <label for="yachtOwner">Owner:</label>
            <input type="text" name="yachtOwner" value="{{ $yacht->owner ?? old("yachtOwner") }}">  
            @error('yachtOwner')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>


        <span class="section-header">About skipper:</span>
        @isset($skipper)
            <span class="info-message">Skipper already exists in database</span>
        @endisset
        
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
            <label for="skipperPersonalIdNumber">Personal ID number:</label>
            <input type="text" name="skipperPersonalIdNumber" value="{{ $skipper->personal_id_number ?? old("skipperPersonalIdNumber") }}">
            @error('skipperPersonalIdNumber')
                <div class="error-message"> {{ $message }} </div>
            @enderror
        </div>

        <div>
            <label for="skipperCountry">Country:</label>
            <input type="text" name="skipperCountry" value="{{ $skipper->country ?? old("skipperCountry") }}">
            @error('skipperCountry')
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

        <button class="link-button">save</button>
    </form>
@endsection