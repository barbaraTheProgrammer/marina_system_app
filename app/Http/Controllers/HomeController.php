<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $places = DB::table('places')
            ->orderBy('pier')
            ->orderBy('spot_number')
            ->get();

        $piers = DB::table('places')
            ->select('pier')
            ->orderBy('pier')
            ->get();

        $uniquePiers = $piers->unique();

        return view('home', compact('places', 'uniquePiers'));
    }
}
