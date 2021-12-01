<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkipperController extends Controller
{
    public function index() {
        return view('skipper.index');
    }
}
