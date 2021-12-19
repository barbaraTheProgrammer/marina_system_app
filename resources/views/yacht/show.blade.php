@extends('layouts.app')

@section('content')
    @if ($yacht == null)
    <h1 class="header">Yacht doesn't exists</h1>
    @else
    <h1 class="header">Details of yacht {{ $yacht->name }}</h1>

    <div class="details-wrapper">
        <div>
            <span class="detail-label">Name:</span> {{ $yacht->name }}
        </div>
        <div>
            <span class="detail-label">Registration number:</span> {{ $yacht->registration_number }}
        </div>
        <div>
            <span class="detail-label">Type:</span> {{ $yacht->type }}
        </div>
        <div>
            <span class="detail-label">Length:</span> {{ $yacht->length }}
        </div>
        <div>
            <span class="detail-label">Owner:</span> {{ $yacht->owner }}
        </div>

        <div class="administration-information">
            <div>
                <span class="info-label">Created by:</span> {{ $yachtCreatedBy->name }}
            </div>
            <div>
                <span class="info-label">Created at:</span> {{ $yacht->created_at }}
            </div>
            <div>
                <span class="info-label">Last update:</span> {{ $yacht->updated_at }} 
                <span class="info-label">by:</span> {{ $yachtUpdatedBy->name }}
            </div>            
        </div>
        

        <div class="listing-wrapper">
            <h3 class="yacht-section-header">History</h3>
            @forelse ($archivedRecords as $archivedRecord)
                <h5>From: <strong>{{ $archivedRecord->date_of_come }}</strong> to: <strong>{{ $archivedRecord->date_of_leave }}</strong></h5>
                <div class="yacht-history-listing">
                    <div class="listing-column">
                        <div>
                            <span>Pier: {{ $archivedRecord->pier }}</span>
                        </div>
                        <div>
                            <span>Spot number: {{ $archivedRecord->spot_number }}</span>
                        </div>
                        <div>
                            <span>Date of come: {{ $archivedRecord->date_of_come }}</span> 
                        </div>
                        <div>
                            <span>Date of leave: {{ $archivedRecord->date_of_leave }}</span> 
                        </div>
                    </div>
                    <div class="listing-column">
                        <div>
                            <span>Yacht name: {{ $archivedRecord->yacht_name }}</span>
                        </div>
                        <div>
                            <span>Yacht registration no: {{ $archivedRecord->yacht_registration_number }}</span>
                        </div>
                        <div>
                            <span>Yacht type: {{ $archivedRecord->yacht_type }}</span>
                        </div>
                        <div>
                            <span>Yacht length: {{ $archivedRecord->yacht_length }}</span>
                        </div>
                        <div>
                            <span>Yacht owner: {{ $archivedRecord->yacht_owner }}</span> 
                        </div>
                    </div>
                    <div class="listing-column">
                        <div>
                            <span>Skipper name: {{ $archivedRecord->skipper_name }}</span> 
                        </div>
                        <div>
                            <span>Skipper surname: {{ $archivedRecord->skipper_surname }}</span>
                        </div>
                        <div>
                            <span>Skipper personal id no: {{ $archivedRecord->skipper_personal_id_number }}</span>
                        </div>
                        <div>
                            <span>Skipper country: {{ $archivedRecord->skipper_country }}</span>
                        </div>
                        <div>
                            <span>Skipper email: {{ $archivedRecord->skipper_email }}</span> 
                        </div>
                    </div>
                </div>
            @empty
                <span>Yacht has no history, but it is
                    <a href="{{ route('trafficShow', $currTrafficRecord->id) }}">in use right now</a>
                </span>
            @endforelse
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