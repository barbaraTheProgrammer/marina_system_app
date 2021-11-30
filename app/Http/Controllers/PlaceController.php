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
        $spotNumber = $validatedData['spotNumber'];
        $status = $validatedData['status'];
        $currUserId = $this->getCurrUserId();
            
        DB::table('places')->insertGetId(['pier' => $pier, 'spot_number' => $spotNumber, 'status' => $status, 'created_by' => $currUserId]);

        return redirect()->route('placeIndex');
    }

    public function show($placeId) {
        $place = DB::table('places')->where('id', $placeId)->get()->first();
        $placeCreatedBy = DB::table('users')->where('id', $place->created_by)->get()->first()->name;
        
        return view('place.show', compact('place','placeCreatedBy'));
    }

    public function edit($placeId) {
        $place = DB::table('places')->where('id', $placeId)->get()->first();

        return view('place.edit', compact('place'));
    }

    public function update($placeId) {
        
        $validatedData = $this->validatedPlaceData();

        $pier = $validatedData['pier'];
        $spotNumber = $validatedData['spotNumber'];
        $status = $validatedData['status'];
        $currUserId = $this->getCurrUserId();    

        DB::table('places')->where('id', $placeId)->update(['pier' => $pier, 'spot_number' => $spotNumber, 'status' => $status, 'created_by' => $currUserId]);

        return redirect()->route('placeIndex');
    }

    public function destroy($placeId)
    {
        DB::table('places')->where('id', $placeId)->delete();

        return redirect()->route('placeIndex');
    }

    private function validatedPlaceData()
    {
        return request()->validate([
            'pier' => 'required|alpha',
            'spotNumber' => 'required|integer|min:0',
            'status' => 'required'
        ]);
    }


    private function getCurrUserId() {
        return auth()->user()->id;
    }
}