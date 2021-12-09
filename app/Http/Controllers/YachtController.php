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

        $name = $validatedData['yachtName'];
        $registrationNumber = $validatedData['yachtRegistrationNumber'];
        $type = $validatedData['yachtType'];
        $length = $validatedData['yachtLength'];
        $owner = $validatedData['yachtOwner'];
        $currUserId = $this->getCurrUserId();

        DB::table('yachts')->insertGetId([
            'name' => $name,
            'registration_number' => $registrationNumber,
            'type' => $type, 'length' => $length,
            'owner' => $owner,
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function show($yachtId) {
        $yacht = DB::table('yachts')->where('id', $yachtId)->first();
        $yachtCreatedBy = DB::table('users')->select('name')->where('id', $yacht->created_by)->first();
        $yachtUpdatedBy = DB::table('users')->select('name')->where('id', $yacht->updated_by)->first();
        
        return view('yacht.show', compact('yacht','yachtCreatedBy','yachtUpdatedBy'));
    }

    public function update($yachtId ,$validatedData) {
        $name = $validatedData['yachtName'];
        $registrationNumber = $validatedData['yachtRegistrationNumber'];
        $type = $validatedData['yachtType'];
        $length = $validatedData['yachtLength'];
        $owner = $validatedData['yachtOwner'];
        $currUserId = $this->getCurrUserId();

        DB::table('yachts')->where('id', $yachtId)->update([
            'name' => $name,
            'registration_number' => $registrationNumber,
            'type' => $type, 'length' => $length,
            'owner' => $owner,
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function validatedYachtData() {

        return request()->validate([
            'yachtName' => 'required',
            'yachtRegistrationNumber' => 'required',
            'yachtType' => 'required',
            'yachtLength' => 'required|min:0',
            'yachtOwner' => 'required'
        ]);
    }

    private function getCurrUserId() {
        return auth()->user()->id;
    }
}
