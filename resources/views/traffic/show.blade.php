@extends('layouts.app')

@section('content')
    @if ($trafficRecord == null)
        <h1>Record doesn't exists</h1>
    @else
        <h1>Details of traffic record</h1>
        
        <div class="details-wrapper">
            <div>
                <span>Place:</span>
                <a href="{{ route('placeShow', $trafficRecord->place_id) }}">{{ $place }}</a>
            </div>
            <div>
                <span>Date of come: {{ $trafficRecord->date_of_come }}</span>
            </div>
            <div>
                <span>Date of leave: {{ $trafficRecord->date_of_leave }}</span>
            </div>
            <div>
                <span>Yacht:</span>
                <a href="{{ route('yachtShow', $trafficRecord->yacht_id) }}">{{ $yachtName }}</a>
            </div>
            <div>
                <span>Skipper:</span>
                <a href="{{ route('skipperShow', $trafficRecord->skipper_id) }}">{{ $skipperName }} {{ $skipperSurname }}</a>
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
        
            <div class="action-buttons">
                <a class="link-button" href="{{ route('trafficArchive', $trafficRecord->id) }}">archive record</a>
            </div>
        </div>
    @endif
@endsection