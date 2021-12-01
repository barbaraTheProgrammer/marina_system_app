@extends('layouts.app')

@section('content')

<h1>Edit place</h1>

<form action="{{ route('placeUpdate', $place->id) }}" method="post">

    @method("PUT")

    <div>
        <label for="pier">Pier</label>
        <input type="text" name="pier" autocomplete="off" value=" {{ $place->pier }} ">
        @error('pier')
            <div class="error-message"> {{ $message }} </div>
        @enderror
    </div>
    
    <div>
        <label for="spotNumber">Spot number</label>
        <input type="text" name="spotNumber" autocomplete="off" value=" {{ $place->spot_number }}">
        @error('spotNumber')
            <div class="error-message"> {{ $message }} </div>
        @enderror
    </div>

    <div>
        <label for="status">Status</label>
            <input type="radio" value="1" name="status" checked/>
            <label>active</label>
            
            <input type="radio" value="0" name="status"/>
            <label>inactive</label>
    </div>

    @csrf

    <button class="link-button">update place</button>
</form>

@endsection