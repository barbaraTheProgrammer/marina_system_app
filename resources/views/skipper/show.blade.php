@extends('layouts.app')

@section('content')
    @if ($skipper == null)
        <h1>Skipper doesn't exists</h1>
    @else
        <h1>Details of skipper</h1>
        
        <div class="details-wrapper">
            <div>
                <span>Name: {{ $skipper->name }}</span>
            </div>
            <div>
                <span>Surname: {{ $skipper->surname }}</span>
            </div>
            <div>
                <span>Personal ID number: {{ $skipper->personal_id_number }}</span>
            </div>
            <div>
                <span>Country: {{ $skipper->country }}</span>
            </div>
            <div>
                <span>Email: {{ $skipper->email }}</span>
            </div>
            <div>
                <span>Created by: {{ $skipperCreatedBy->name }}</span>
            </div>
            <div>
                <span>Created at: {{ $skipper->created_at }}</span>
            </div>
            <div>
                <span>Last update: {{ $skipper->updated_at }} by: {{ $skipperUpdatedBy->name }}</span>
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