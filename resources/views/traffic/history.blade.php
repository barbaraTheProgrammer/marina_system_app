@extends('layouts.app')

@section('content')

    <div class="history-header-wrapper">
        <a href="{{ route('trafficIndex') }}" class="button">show current state</a>
        <h3 class="header">History 
            @if (isset(request()->date))
                <span class="info-message">filtered: {{ request()->date }}</span>
            @endif
        </h3>
    </div>

    <div class="filters-wrapper">
        <h5>filters:</h5>
        <form action="{{ route('trafficShowHistory', ['filter' => 'filtered']) }}" method="get">
            <label for="date">Date: </label>
            <input type="date" name="date">
            @error('date')
                <div class="error-message"> {{ $message }} </div>
            @enderror
            
            @csrf
            <button class="button">show</button>
        </form>
        <a href="{{ route('trafficShowHistory', ['filter' => 'all']) }}" class="button">clear filters</a>
    </div>

    <div class="listing-wrapper">
        @forelse ($archivedRecords as $archivedRecord)
            <div class="listing-element">
                <h5><strong>{{ $archivedRecord->pier }}{{ $archivedRecord->spot_number }}</strong>
                     from: <strong>{{ $archivedRecord->date_of_come }}</strong> 
                     to: <strong>{{ $archivedRecord->date_of_leave }}</strong>
                </h5>
                <div class="listing history-listing">
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
                            <span>Created by: 
                                @foreach ($users as $user)
                                    @if ($archivedRecord->created_by == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </span> 
                        </div>
                        <div>
                            <span>Created at: {{ $archivedRecord->created_at }}</span>
                        </div>
                        <div>
                            <span>Last update by: 
                                @foreach ($users as $user)
                                    @if ($archivedRecord->updated_by == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                        <div>
                            <span>Last update at: {{ $archivedRecord->updated_at }}</span> 
                        </div>
                        <div>
                            <span>Archived by: 
                                @foreach ($users as $user)
                                    @if ($archivedRecord->archived_by == $user->id)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                        <div>
                            <span>Archived at: {{ $archivedRecord->archived_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h5 class="info-message">There are no archived records</h5 class="info-message">
        @endforelse
    </div>
@endsection