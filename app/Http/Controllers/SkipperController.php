<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SkipperController extends Controller
{
    public function index() {
        return view('skipper.index');
    }

    public function store($validatedData) {

        $name = $validatedData['skipperName'];
        $surname = $validatedData['skipperSurname'];
        $personalIdNumber = $validatedData['skipperPersonalIdNumber'];
        $country = $validatedData['skipperCountry'];
        $email = $validatedData['skipperEmail'];
        $currUserId = $this->getCurrUserId();

        DB::table('skippers')->insertGetId([
            'name' => $name,
            'surname' => $surname,
            'personal_id_number' => $personalIdNumber,
            'country' => $country,
            'email' => $email,
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function validatedSkipperData() {
        
        return request()->validate([
            'skipperName' => 'required',
            'skipperSurname' => 'required',
            'skipperPersonalIdNumber' => 'required',
            'skipperCountry' => 'required',
            'skipperEmail' => 'required|email'
        ]);
    }

    private function getCurrUserId() {
        return auth()->user()->id;
    }
}
