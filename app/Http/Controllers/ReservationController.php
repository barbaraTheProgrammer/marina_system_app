<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index() {
        return view('reservation.index');
    }

    public function checkAvaliablePlaces() {
        $validatedData = request()->validate([
            'dateOfCome' => 'required',
            'dateOfLeave' => 'required|after:dateOfCome'
        ]);

        $checkingDateOfCome = $validatedData['dateOfCome'];
        $checkingDateOfLeave = $validatedData['dateOfLeave'];

        $avaliablePlaces = DB::table('places')
            ->where('status', '1')
            ->whereNotExists( function ($query) use ($checkingDateOfCome, $checkingDateOfLeave) {
                $query->select(DB::raw(1))
                ->from('traffic')
                ->whereColumn('places.id', 'traffic.place_id')
                ->whereDate('date_of_come', '<=', $checkingDateOfLeave)
                ->whereDate('date_of_leave', '>=', $checkingDateOfCome);
            })
            ->whereNotExists( function ($query) use ($checkingDateOfCome, $checkingDateOfLeave) {
                $query->select(DB::raw(1))
                ->from('reservations')
                ->whereColumn('places.id', 'reservations.place_id')
                ->whereDate('date_of_come', '<=', $checkingDateOfLeave)
                ->whereDate('date_of_leave', '>=', $checkingDateOfCome);
            })
            ->orderBy('pier', 'asc')
            ->orderBy('spot_number','asc')
            ->get()
            ->all();

        return view('reservation.avaliable-places', compact('avaliablePlaces', 'checkingDateOfCome', 'checkingDateOfLeave'));
    }

    public function create() {
        return view('reservation.create');
    }

    public function store() {
        return view('reservation.index');
    }
}
