@extends('layouts.app')

@section('content')
    @if ($trafficRecord == null)
        <h1>Record doesn't exists</h1>
    @else
        <h1>Details of traffic record</h1>
        
        <div class="details-wrapper">
            <div>
                <span>Place id:</span>
                <a href="{{ route('placeShow', $trafficRecord->place_id) }}">{{ $trafficRecord->place_id }}</a>
            </div>
            <div>
                <span>Date of come: {{ $trafficRecord->date_of_come }}</span>
            </div>
            <div>
                <span>Date of leave: {{ $trafficRecord->date_of_leave }}</span>
            </div>
            <div>
                <span>Yacht id:</span>
                <a href="{{ route('yachtShow', $trafficRecord->yacht_id) }}">{{ $trafficRecord->yacht_id }}</a>
            </div>
            <div>
                <span>Skipper id:</span>
                <a href="{{ route('skipperShow', $trafficRecord->skipper_id) }}">{{ $trafficRecord->skipper_id }}</a>
            </div>
            <div>
                <span>Created by: {{ $recordCreatedBy }}</span>
            </div>
            <div>
                <span>Created at: {{ $trafficRecord->created_at }}</span>
            </div>
            <div>
                <span>Last update: {{ $trafficRecord->updated_at }} by: {{ $recordUpdatedBy }}</span>
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