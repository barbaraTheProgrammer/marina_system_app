<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YachtController extends Controller
{
    public function index() {
        return view('yacht.index');
    }

    public function checkIfExists() {
        $validatedData = request()->validate([
            'registrationNumber' => 'required',
        ]);

        $registrationNumber = $validatedData['registrationNumber'];
        dd($registrationNumber);
    }
}
