@extends('layouts.app')

@section('content')
    @if ($trafficRecord == null)
        <h1 class="header">Record doesn't exists</h1>
    @else
        <h1 class="header">Details of traffic record</h1>
        
        <div class="details-wrapper">
            <div>
                <span class="detail-label">Place:</span>
                <a href="{{ route('placeShow', $trafficRecord->place_id) }}">{{ $place }}</a>
            </div>
            <div>
                <span class="detail-label">Date of come:</span> {{ $trafficRecord->date_of_come }}
            </div>
            <div>
                <span class="detail-label">Date of leave:</span> {{ $trafficRecord->date_of_leave }}
            </div>
            <div>
                <span class="detail-label">Yacht:</span>
                <a href="{{ route('yachtShow', $trafficRecord->yacht_id) }}">{{ $yachtName->name }}</a>
            </div>
            <div>
                <span class="detail-label">Skipper:</span>
                <a href="{{ route('skipperShow', $trafficRecord->skipper_id) }}">{{ $skipperName->name }} {{ $skipperSurname->surname }}</a>
            </div>
        
            <div class="action-buttons">
                <a class="link-button" href="{{ route('trafficArchive', $trafficRecord->id) }}" onclick="return confirm('Are you sure?')">archive record</a>
            </div>

            <div class="administration-information">
                <div>
                    <span class="info-label">Created by:</span> {{ $recordCreatedBy->name }}
                </div>
                <div>
                    <span class="info-label">Created at:</span> {{ $trafficRecord->created_at }}
                </div>
                <div>
                    <span class="info-label">Last update:</span> {{ $trafficRecord->updated_at }} 
                    <span class="info-label">by:</span>  {{ $recordUpdatedBy->name }}
                </div>
            </div>
        </div>
    @endif
@endsection