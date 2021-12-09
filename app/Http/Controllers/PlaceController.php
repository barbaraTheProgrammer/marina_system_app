<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlaceController extends Controller
{
    public function index() {
        $places = DB::table('places')
            ->orderBy('pier', 'asc')
            ->orderBy('spot_number','asc')
            ->get()
            ->all();

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
            
        DB::table('places')->insertGetId([
            'pier' => $pier,
            'spot_number' => $spotNumber,
            'status' => $status,
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('placeIndex');
    }

    public function show($placeId) {
        $place = DB::table('places')->where('id', $placeId)->first();

        $placeCreatedBy = DB::table('users')->select('name')->where('id', $place->created_by)->first();
        $placeUpdatedBy = DB::table('users')->select('name')->where('id', $place->updated_by)->first();
        
        return view('place.show', compact('place','placeCreatedBy','placeUpdatedBy'));
    }

    public function edit($placeId) {
        $place = DB::table('places')->where('id', $placeId)->first();

        return view('place.edit', compact('place'));
    }

    public function update($placeId) {
        $validatedData = $this->validatedPlaceData();

        $pier = $validatedData['pier'];
        $spotNumber = $validatedData['spotNumber'];
        $status = $validatedData['status'];
        $currUserId = $this->getCurrUserId();    

        DB::table('places')->where('id', $placeId)->update([
            'pier' => $pier,
            'spot_number' => $spotNumber,
            'status' => $status,
            'updated_by' => $currUserId,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('placeShow', $placeId);
    }

    public function destroy($placeId) {
        $connectedRecord = DB::table('traffic')->select('id')->where('id', $placeId)->first();
        $message = "Place is currently in use. Can not delete.";

        if ($connectedRecord == null) {
            DB::table('places')->where('id', $placeId)->delete();
            return redirect()->route('placeIndex');
        } else {
            return redirect()->route('placeIndex', ['message' => $message]);
        }
    }

    private function validatedPlaceData() {
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