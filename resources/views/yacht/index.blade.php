@extends('layouts.app')

@section('content')
    <h1 class="header">Yachts</h1>

    <div class="listing-wrapper">
        <div class="yachts-listing header-element">
            <span>Name</span>
            <span>Registration no</span>
            <span>Owner</span>
        </div>
        @forelse($yachts as $yacht)
            <div class="listing yachts-listing">
                <span>{{ $yacht->name }}</span>
                <span>{{ $yacht->registration_number }}</span>
                <span>{{ $yacht->owner }}</span>
                <div>
                    <a href="{{ route('yachtShow', $yacht->id) }}">show details</a>
                </div>
            </div>
        @empty
            <h5 class="info-message">There are no "Yachts" in database</h5 class="info-message">
        @endforelse       
    </div>

@endsection