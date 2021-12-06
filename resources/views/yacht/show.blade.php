@extends('layouts.app')

@section('content')
    @if ($yacht == null)
    <h1>Yacht doesn't exists</h1>
    @else
    <h1>Details of yacht</h1>

    <div class="details-wrapper">
        <div>
            <span>Name: {{ $yacht->name }}</span>
        </div>
        <div>
            <span>Registration number: {{ $yacht->registration_number }}</span>
        </div>
        <div>
            <span>Type: {{ $yacht->type }}</span>
        </div>
        <div>
            <span>Length: {{ $yacht->length }}</span>
        </div>
        <div>
            <span>Owner: {{ $yacht->owner }}</span>
        </div>
        <div>
            <span>Created by: {{ $yachtCreatedBy }}</span>
        </div>
        <div>
            <span>Created at: {{ $yacht->created_at }}</span>
        </div>
        <div>
            <span>Last update: {{ $yacht->updated_at }} by: {{ $yachtUpdatedBy }}</span>
        </div>
    
        {{-- <div class="action-buttons">
            <a class="link-button" href="{{ route('placeEdit', $place->id) }}">edit place</a>
    
            <form action="{{ route('placeDestroy', $place->id) }}" method="post" onclick="return confirm('Are you sure?')">
                @method('DELETE')
                @csrf
                <button class="link-button">delete</button>
            </form>
        </div> --}}
    </div>
    @endif
@endsection