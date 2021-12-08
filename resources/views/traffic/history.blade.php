@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('trafficIndex') }}" class="button">current state</a>
        <a href="{{ route('trafficShowHistory') }}" class="button">show history</a>
    </div>
    <div>
        <h2>History</h2>
    </div>

    <div class="listing-wrapper">
        @forelse ($archivedRecords as $archivedRecord)
            <h5>{{ $archivedRecord->pier }}{{ $archivedRecord->spot_number }} from: {{ $archivedRecord->date_of_come }} to: {{ $archivedRecord->date_of_leave }}</h5>
            <div class="history-listing">
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
                <div class="listing-column">
                    <div>
                        <span>Created by: {{ $archivedRecord->created_by }}</span> 
                    </div>
                    <div>
                        <span>Created at: {{ $archivedRecord->created_at }}</span>
                    </div>
                    <div>
                        <span>Last update by: {{ $archivedRecord->updated_by }}</span>
                    </div>
                    <div>
                        <span>Last update at: {{ $archivedRecord->updated_at }}</span> 
                    </div>
                    <div>
                        <span>Archived by: {{ $archivedRecord->archived_by }}</span>
                    </div>
                    <div>
                        <span>Archived at: {{ $archivedRecord->archived_at }}</span>
                    </div>
                </div>
            </div>
        @empty
            <h5 class="info-message">There are no archived records</h5 class="info-message">
        @endforelse
    </div>
@endsection