@extends('layouts.app')

@section('content')
    @if ($yacht == null)
    <h1>Yacht doesn't exists</h1>
    @else
    <h1>Details of yacht</h1>

    <div class="details-wrapper">
        
    </div>
    @endif
@endsection