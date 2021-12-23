<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public function index() {
        $dateFilter = request()->dateFilter;

        $places = DB::table('places')
            ->orderBy('pier')
            ->orderBy('spot_number')
            ->get();

        $piers = DB::table('places')
            ->select('pier')
            ->orderBy('pier')
            ->get()
            ->unique();

        
        if ($dateFilter != null) {
            $reservations = DB::table('reservations')
                ->select('id', 'place_id')
                ->whereDate('date_of_come', '<=', $dateFilter)
                ->whereDate('date_of_leave', '>=', $dateFilter)
                ->get()
                ->all();

            return view('home', compact('places', 'piers', 'reservations'));

        } else {
            $now = Carbon::now();

            $traffic = DB::table('traffic')
                ->select('id', 'place_id')
                ->whereDate('date_of_come', '<=', $now)
                ->whereDate('date_of_leave', '>=', $now)
                ->orderBy('place_id', 'asc')
                ->get()
                ->all();

            return view('home', compact('places', 'piers', 'traffic'));
        }
    }
}
