<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index() {
        $reservations = DB::table('reservations')
            ->orderBy('date_of_come')
            ->get()->all();

        $places = DB::table('places')->get()->all();

        return view('reservation.index', compact('reservations','places'));
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

    public function create($placeId, $dateOfCome, $dateOfLeave) {
        $place = DB::table('places')->where('id', $placeId)->first();

        return view('reservation.create', compact('place', 'dateOfCome', 'dateOfLeave'));
    }

    public function store() {
        $validatedData = request()->validate([
            'skipperName' => 'required',
            'skipperSurname' => 'required',
            'skipperEmail' => 'required|email',
            'yachtName' => 'required',
            'yachtLength' => 'required|numeric|min:0'
        ]);
        $now = Carbon::now();
        $currUser = $his->getCurrUserId();

        DB::table('reservations')->insertGetId([
            'place_id' => request()->placeId,
            'date_of_come' => request()->dateOfCome,
            'date_of_leave' => request()->dateOfLeave,
            'skipper_name' => $validatedData['skipperName'],
            'skipper_surname' => $validatedData['skipperSurname'],
            'skipper_email' => $validatedData['skipperEmail'],
            'yacht_name' => $validatedData['yachtName'],
            'yacht_length' => $validatedData['yachtLength'],
            'created_by' => $currUser,
            'updated_by' => $currUser,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        return redirect()->route('reservationIndex');
    }

    public function show($recordId) {
        $reservation = DB::table('reservations')->where('id', $recordId)->first();
        $places = DB::table('places')->get()->all();
        $recordCreatedBy = DB::table('users')->select('name')->where('id', $reservation->created_by)->first();
        $recordUpdatedBy = DB::table('users')->select('name')->where('id', $reservation->updated_by)->first();

        return view('reservation.show', compact('reservation', 'places', 'recordCreatedBy', 'recordUpdatedBy'));
    }

    private function getCurrUserId() {
        return auth()->user()->id;
    }
}
