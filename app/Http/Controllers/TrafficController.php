<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\YachtController;
use App\Http\Controllers\SkipperController;

class TrafficController extends Controller
{
    protected $YachtController;
    protected $SkipperController;

    public function __construct(YachtController $YachtController, SkipperController $SkipperController) {
        $this->YachtController = $YachtController;
        $this->SkipperController = $SkipperController;
    }


    public function index() {
        $traffic = DB::table('traffic')->get()->all();
        $places = DB::table('places')->get()->all();
        $yachts = DB::table('yachts')->get()->all();

        return view('traffic.index', ['traffic' => $traffic, 'places' => $places, 'yachts' => $yachts]);
    }

    public function create() {
        $validatedData = request()->validate([
            'registrationNumber' => 'required',
            'skipperEmail' => 'required|email'
        ]);

        $registrationNumber = $validatedData['registrationNumber'];
        $skipperEmail = $validatedData['skipperEmail'];

        $yacht = DB::table('yachts')->where('registration_number', $registrationNumber)->first();
        $skipper = DB::table('skippers')->where('email', $skipperEmail)->first();

        $avaliablePlaces = DB::table('places')->where('status', '1')->get()->all();

        return view('traffic.create', ['yacht' => $yacht, 'skipper' => $skipper, 'registrationNumber' => $registrationNumber, 'skipperEmail' => $skipperEmail, 'avaliablePlaces' => $avaliablePlaces]);
    }

    public function store() {
        $validatedMarinaData = $this->validatedMarinaData();
        $validatedYachtData = $this->YachtController->validatedYachtData();
        $validatedSkipperData = $this->SkipperController->validatedSkipperData();

        $yachtRegistrationNumber = $validatedYachtData['yachtRegistrationNumber'];
        $skipperEmail = $validatedSkipperData['skipperEmail'];
        
        $yacht = DB::table('yachts')->where('registration_number', $yachtRegistrationNumber)->first();
        $skipper = DB::table('skippers')->where('email', $skipperEmail)->first();

        if ($yacht == null) {
            $this->YachtController->store($validatedYachtData);
        } else {
            $this->YachtController->update($yacht->id ,$validatedYachtData);
        }

        if ($skipper == null) {
            $this->SkipperController->store($validatedSkipperData);
        } else {
            $this->SkipperController->update($skipper->id ,$validatedSkipperData);
        }

        $pier = $validatedMarinaData['pier'];
        $spotNumber = $validatedMarinaData['spotNumber'];
        
        $place = DB::table('places')->where('pier', $pier)->where('spot_number', $spotNumber)->first();
        $yacht = DB::table('yachts')->where('registration_number', $yachtRegistrationNumber)->first();
        $skipper = DB::table('skippers')->where('email', $skipperEmail)->first();

        $placeId = $place->id;
        $dateOfCome = $validatedMarinaData['dateOfCome'];
        $dateOfLeave = $validatedMarinaData['dateOfLeave'];
        $yachtId = $yacht->id;
        $skipperId = $skipper->id;
        $currUserId = $this->getCurrUserId();

        DB::table('traffic')->insertGetId([
            'place_id' => $placeId,
            'date_of_come' => $dateOfCome,
            'date_of_leave' => $dateOfLeave,
            'yacht_id' => $yachtId,
            'skipper_id' => $skipperId,
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('trafficIndex');   
    }

    public function show($recordId) {
        $trafficRecord = DB::table('traffic')->where('id', $recordId)->first();
        $yachtName = DB::table('yachts')->where('id', $trafficRecord->yacht_id)->first()->name;
        $skipperName = DB::table('skippers')->where('id', $trafficRecord->skipper_id)->first()->name;
        $skipperSurname = DB::table('skippers')->where('id', $trafficRecord->skipper_id)->first()->surname;
        $recordCreatedBy = DB::table('users')->where('id', $trafficRecord->created_by)->first()->name;
        $recordUpdatedBy = DB::table('users')->where('id', $trafficRecord->updated_by)->first()->name;
        
        return view('traffic.show', compact('trafficRecord','recordCreatedBy','recordUpdatedBy','yachtName','skipperName','skipperSurname'));
    }

    public function validatedMarinaData() {

        return request()->validate([
            'place' => 'required',
            'dateOfCome' => 'required',
            'dateOfLeave' => 'required|after:dateOfCome'
        ]);
    }

    private function getCurrUserId() {
        return auth()->user()->id;
    }
}
