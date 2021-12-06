<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SkipperController extends Controller
{
    public function index() {
        $skippers = DB::table('skippers')->get()->all();

        return view('skipper.index', ['skippers' => $skippers]);
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

    public function show($skipperId) {
        $skipper = DB::table('skippers')->where('id', $skipperId)->get()->first();
        $skipperCreatedBy = DB::table('users')->where('id', $skipper->created_by)->get()->first()->name;
        $skipperUpdatedBy = DB::table('users')->where('id', $skipper->updated_by)->get()->first()->name;
        
        return view('skipper.show', compact('skipper','skipperCreatedBy','skipperUpdatedBy'));
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
