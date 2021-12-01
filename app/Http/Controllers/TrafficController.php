<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function index() {
        return view('traffic.index');
    }

    public function create() {
        return view('traffic.create');
    }

    public function store() {
        return redirect()->route('trafficIndex');
    }
}
