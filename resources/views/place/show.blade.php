@extends('layouts.app')

@section('content')

@if ($place == null)
    <h1 class="header">Place doesn't exists</h1>
@else
    <h1 class="header">Details of place</h1>
    
    <div class="details-wrapper">
        <div>
            <span class="detail-label">Pier:</span> {{ $place->pier }}
        </div>
        <div>
            <span class="detail-label">Spot number:</span> {{ $place->spot_number }}
        </div>
        <div>
            <span class="detail-label">
                Status:
            </span>
            @if ($place->status == '1')
                active
            @else
                inactive
            @endif
        </div>
    </div>

    <div class="buttons-wrapper">
        <div>
            <a class="link-button" href="{{ route('placeEdit', $place->id) }}">edit place</a>
        </div>
        <div>
            <form action="{{ route('placeDestroy', $place->id) }}" method="post" onclick="return confirm('Are you sure?')">
                @method('DELETE')
                @csrf
                <button class="link-button">delete</button>
            </form>
        </div>
    </div>

    <div class="administration-information">
        <div>
            <span class="info-label">Created by:</span> {{ $placeCreatedBy->name }}
        </div>
        <div>
            <span class="info-label">Created at:</span> {{ $place->created_at }}
        </div>
        <div>
            <span class="info-label">Last update:</span> {{ $place->updated_at }}
            <span class="info-label">by:</span>  {{ $placeUpdatedBy->name }}
        </div>
    </div>
@endif

@endsection