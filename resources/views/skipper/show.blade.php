@extends('layouts.app')

@section('content')
    @if ($skipper == null)
        <h1 class="header">Skipper doesn't exists</h1>
    @else
        <h1 class="header">Details of skipper</h1>
        
        <div class="details-wrapper">
            <div>
                <span class="detail-label">Name:</span> {{ $skipper->name }}
            </div>
            <div>
                <span class="detail-label">Surname:</span> {{ $skipper->surname }}
            </div>
            <div>
                <span class="detail-label">Personal ID number:</span> {{ $skipper->personal_id_number }}
            </div>
            <div>
                <span class="detail-label">Country:</span> {{ $skipper->country }}
            </div>
            <div>
                <span class="detail-label">Email:</span> {{ $skipper->email }}
            </div>
            
            <div class="administration-information">
                <div>
                    <span class="info-label">Created by:</span> {{ $skipperCreatedBy->name }}
                </div>
                <div>
                    <span class="info-label">Created at:</span> {{ $skipper->created_at }}
                </div>
                <div>
                    <span class="info-label">Last update:</span> {{ $skipper->updated_at }} 
                    <span class="info-label">by:</span> {{ $skipperUpdatedBy->name }}
                </div>         
            </div>
        </div>
    @endif

@endsection