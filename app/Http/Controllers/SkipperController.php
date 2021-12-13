<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SkipperController extends Controller
{
    public function index() {
        $skippers = DB::table('skippers')
            ->orderBy('name', 'asc')
            ->orderBy('surname', 'asc')
            ->get()
            ->all();

        return view('skipper.index', ['skippers' => $skippers]);
    }

    public function store($validatedData) {

        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();

        DB::table('skippers')->insertGetId([
            'name' => $validatedData['skipperName'],
            'surname' => $validatedData['skipperSurname'],
            'personal_id_number' => $validatedData['skipperPersonalIdNumber'],
            'country' => $validatedData['skipperCountry'],
            'email' => $validatedData['skipperEmail'],
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function show($skipperId) {
        $skipper = DB::table('skippers')->where('id', $skipperId)->first();
        $skipperCreatedBy = DB::table('users')->select('name')->where('id', $skipper->created_by)->first();
        $skipperUpdatedBy = DB::table('users')->select('name')->where('id', $skipper->updated_by)->first();
        
        return view('skipper.show', compact('skipper','skipperCreatedBy','skipperUpdatedBy'));
    }

    public function update($skipperId ,$validatedData) {

        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();

        DB::table('skippers')->where('id', $skipperId)->update([
            'name' => $validatedData['skipperName'],
            'surname' => $validatedData['skipperSurname'],
            'personal_id_number' => $validatedData['skipperPersonalIdNumber'],
            'country' => $validatedData['skipperCountry'],
            'email' => $validatedData['skipperEmail'],
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => $now,
            'updated_at' => $now
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
