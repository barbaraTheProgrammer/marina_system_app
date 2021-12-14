@extends('layouts.app')

@section('content')

<div class="marina-diagram">
    <h1>Marina diagram</h1>

    @forelse ($uniquePiers as $singlePier)
        <div class="pier-label-wrapper"><span class="pier-label">PIER {{ $singlePier->pier }}</span></div>
        <div class="single-pier">
            @foreach ($places as $place)
                @if ($place->pier == $singlePier->pier)
                    @if ($place->status == 1)
                        <div class="place-tile active">
                            <a href="{{ route('placeShow', $place->id) }}">
                                {{ $place->pier }}{{ $place->spot_number }}
                            </a>
                        </div>
                    @endif
                    @if ($place->status == 0)
                        <div class="place-tile inactive">
                            <a href="{{ route('placeShow', $place->id) }}">
                                {{ $place->pier }}{{ $place->spot_number }}
                            </a>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    @empty
        <h2>No places in marina system yet</h2>
    @endforelse
    

    
</div>


@endsection
