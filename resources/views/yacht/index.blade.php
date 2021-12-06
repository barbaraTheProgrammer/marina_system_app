@extends('layouts.app')

@section('content')
    <h1>Yachts</h1>

    <div class="listing-wrapper">
        @if ($yachts != null)
            <div class="yachts-listing header-element">
                <span>Name</span>
                <span>Registration no</span>
                <span>Owner</span>
            </div>
            @foreach ($yachts as $yacht)
                <div class="yachts-listing">
                    <span>{{ $yacht->name }}</span>
                    <span>{{ $yacht->registration_number }}</span>
                    <span>{{ $yacht->owner }}</span>
                    <div>
                        <a href="{{ route('yachtShow', $yacht->id) }}">show details</a>
                    </div>
                </div>
            @endforeach        
        @else
            <h2>There are no "Yachts" in database</h2>
        @endif
    </div>

@endsection