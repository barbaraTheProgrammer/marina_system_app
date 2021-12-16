<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class YachtController extends Controller
{
    public function index() {
        $yachts = DB::table('yachts')->orderBy('name', 'asc')->get()->all();
        return view('yacht.index', ['yachts' => $yachts]);
    }

    public function store($validatedData) {
        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();

        DB::table('yachts')->insertGetId([
            'name' => $validatedData['yachtName'],
            'registration_number' => $validatedData['yachtRegistrationNumber'],
            'type' => $validatedData['yachtType'],
            'length' => $validatedData['yachtLength'],
            'owner' => $validatedData['yachtOwner'],
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    public function show($yachtId) {
        $yacht = DB::table('yachts')->where('id', $yachtId)->first();
        $yachtCreatedBy = DB::table('users')->select('name')->where('id', $yacht->created_by)->first();
        $yachtUpdatedBy = DB::table('users')->select('name')->where('id', $yacht->updated_by)->first();

        $currTrafficRecord = DB::table('traffic')->select('id')->where('yacht_id', $yachtId)->first();
        $archivedRecords = DB::table('traffic_history')->where('yacht_id', $yachtId)->get()->all();
        
        return view('yacht.show', compact('yacht','yachtCreatedBy','yachtUpdatedBy','currTrafficRecord','archivedRecords'));
    }

    public function update($yachtId ,$validatedData) {
        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();

        DB::table('yachts')->where('id', $yachtId)->update([
            'name' => $validatedData['yachtName'],
            'registration_number' => $validatedData['yachtRegistrationNumber'],
            'type' => $validatedData['yachtType'],
            'length' => $validatedData['yachtLength'],
            'owner' => $validatedData['yachtOwner'],
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    public function validatedYachtData() {

        return request()->validate([
            'yachtName' => 'required',
            'yachtRegistrationNumber' => 'required',
            'yachtType' => 'required',
            'yachtLength' => 'required|numeric|min:0',
            'yachtOwner' => 'required'
        ]);
    }

    private function getCurrUserId() {
        return auth()->user()->id;
    }
}
