@extends('layouts.app')

@section('content')
    <h1>Create reservation</h1>

    <form action="{{ route('reservationStore') }}" method="post">
        
        @csrf
    </form>
@endsection