@extends('layouts.app')

@section('content')

<h1>Create place</h1>

<form action="{{ route('placeStore') }}" method="post">
    <div>
        <label for="pier">Pier</label>
        <input type="text" name="pier" autocomplete="off" value=" {{ old('pier') }} ">
        @error('pier')
            <div> {{ $message }} </div>
        @enderror
    </div>
    
    <div>
        <label for="spotNumber">Spot number</label>
        <input type="text" name="spotNumber" autocomplete="off" value=" {{ old('spotNumber') }}">
        @error('spotNumber')
            <div> {{ $message }} </div>
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

    <button class="link-button">Add new place</button>
</form>

@endsection