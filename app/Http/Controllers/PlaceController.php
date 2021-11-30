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
        
        $validatedData = $this->validatedPlaceData();

        $pier = $validatedData['pier'];
        $spot_nr = $validatedData['spot_nr'];
        $status = $validatedData['status'];
            

        DB::table('places')->insertGetId(['pier' => $pier, 'spot_nr' => $spot_nr, 'status' => $status]);

        return redirect('/places');
    }

    public function show($placeId) {
        $place = DB::table('places')->where('id', $placeId)->get()->first();
        
        return view('place.show', compact('place'));
    }

    public function edit($placeId) {
        $place = DB::table('places')->where('id', $placeId)->get()->first();

        return view('place.edit', compact('place'));
    }

    public function update($placeId) {
        
        $validatedData = $this->validatedPlaceData();

        $pier = $validatedData['pier'];
        $spot_nr = $validatedData['spot_nr'];
        $status = $validatedData['status'];
            

        DB::table('places')->where('id', $placeId)->update(['pier' => $pier, 'spot_nr' => $spot_nr, 'status' => $status]);

        return redirect('/places');
    }

    public function destroy($placeId)
    {
        DB::table('places')->where('id', $placeId)->delete();

        return redirect('/places');
    }

    private function validatedPlaceData()
    {
        return request()->validate([
            'pier' => 'required|alpha',
            'spot_nr' => 'required|integer|min:0',
            'status' => 'required'
        ]);
    }
}