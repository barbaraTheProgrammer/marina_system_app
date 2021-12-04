<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class YachtController extends Controller
{
    public function index() {
        return view('yacht.index');
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
