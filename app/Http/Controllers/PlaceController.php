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
        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();
            
        DB::table('places')->insertGetId([
            'pier' => $validatedData['pier'],
            'spot_number' => $validatedData['spotNumber'],
            'status' => $validatedData['status'],
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => $now,
            'updated_at' => $now
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
        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();

        if ($validatedData['status'] == '0') {

            $inUse = $this->checkIfInUse($placeId);

            if ($inUse == true) {
                $message = "Place is currently in use (in traffic or reservations). Can not change status to unactive.";
                return redirect()->route('placeIndex', ['message' => $message]);

            } else {
                DB::table('places')->where('id', $placeId)->update([
                    'pier' => $validatedData['pier'],
                    'spot_number' => $validatedData['spotNumber'],
                    'status' => $validatedData['status'],
                    'updated_by' => $currUserId,
                    'updated_at' => $now
                ]);
        
                return redirect()->route('placeShow', $placeId);
            }
        } else {
            DB::table('places')->where('id', $placeId)->update([
                'pier' => $validatedData['pier'],
                'spot_number' => $validatedData['spotNumber'],
                'status' => $validatedData['status'],
                'updated_by' => $currUserId,
                'updated_at' => $now
            ]);
    
            return redirect()->route('placeShow', $placeId);
        }
    }

    public function destroy($placeId) {
        $inUse = $this->checkIfInUse($placeId);

        if ($inUse == true) {
            $message = "Place is currently in use (in traffic or reservations). Can not delete.";
            return redirect()->route('placeIndex', ['message' => $message]);

        } else {
            DB::table('places')->where('id', $placeId)->delete();
            return redirect()->route('placeIndex');
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

    private function checkIfInUse($placeId) {
        $relatedTraffic = DB::table('traffic')->select('id')->where('id', $placeId)->first();
        $relatedReservations = DB::table('reservations')->select('id')->where('id', $placeId)->first();

        if ($relatedTraffic == null && $relatedReservations == null) {
            return false;
        } else {
            return true;
        }
    }
}