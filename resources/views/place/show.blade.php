@extends('layouts.app')

@section('content')

@if ($place == null)
    <h1>Place doesn't exists</h1>
@else
    <h1>Details of place</h1>
    
    <div class="details-wrapper">
        <div>
            <span>Pier: {{ $place->pier }}</span>
        </div>
        <div>
            <span>Spot number: {{ $place->spot_number }}</span>
        </div>
        <div>
            <span>
                Status:
                @if ($place->status == '1')
                    active
                @else
                    inactive
                @endif
            </span>
        </div>
        <div>
            <span>Created by: {{ $placeCreatedBy }}</span>
        </div>
        <div>
            <span>Created at: {{ $place->created_at }}</span>
        </div>
        <div>
            <span>Last update: {{ $place->updated_at }} by: {{ $placeUpdatedBy }}</span>
        </div>
    
        <div class="action-buttons">
            <a class="link-button" href="{{ route('placeEdit', $place->id) }}">edit place</a>
    
            <form action="{{ route('placeDestroy', $place->id) }}" method="post" onclick="return confirm('Are you sure?')">
                @method('DELETE')
                @csrf
                <button class="link-button">delete</button>
            </form>
        </div>
    </div>
@endif

@endsection