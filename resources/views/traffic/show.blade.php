@extends('layouts.app')

@section('content')
    @if ($trafficRecord == null)
        <h1>Record doesn't exists</h1>
    @else
        <h1>Details of traffic record</h1>
        
        <div class="details-wrapper">
            
        </div>
    @endif
@endsection