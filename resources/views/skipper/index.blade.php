@extends('layouts.app')

@section('content')
    <h1>Skippers</h1>

    <div class="listing-wrapper">
        <div class="skippers-listing header-element">
            <span>Name</span>
            <span>Surname</span>
            <span>Email</span>
        </div>
        @forelse ($skippers as $skipper)
            <div class="skippers-listing">
                <span>{{ $skipper->name }}</span>
                <span>{{ $skipper->surname }}</span>
                <span>{{ $skipper->email }}</span>
                <div>
                    <a href="{{ route('skipperShow', $skipper->id) }}">show details</a>
                </div>
            </div>
        @empty
            <h5 class="info-message">There are no "Skippers" in database</h5 class="info-message">
        @endforelse      
    </div>
@endsection