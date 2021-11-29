<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function index() {

        $placesCollection = DB::table('places')->get();
        $places = $placesCollection->all();

        return view('place.index', ['places' => $places]);
    }

    public function create() {

        return view('place.create');
    }

    public function store() {
        
        $validatedData = request()->validate([
            'pier' => 'required|alpha',
            'spot_nr' => 'required|integer|min:0',
            'status' => 'required'
        ]);

        $place = $validatedData['pier'] . $validatedData['spot_nr'];
        $status = $validatedData['status'];
            

        DB::table('places')->insertGetId(['place' => $place, 'status' => $status]);

        return redirect('/places');
    }

    public function show($placeId) {
        $place = DB::table('places')->where('id', $placeId)->get()->first();

        return view('place.show', compact('place'));
    }
}