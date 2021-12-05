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

        return view('traffic.index', ['traffic' => $traffic]);
    }

    public function create() {
        return view('traffic.create');
    }

    public function store() {
        $validatedMarinaData = $this->validatedMarinaData();
        $validatedYachtData = $this->YachtController->validatedYachtData();
        $validatedSkipperData = $this->SkipperController->validatedSkipperData();

        // if the same then store if data is different then update? 
        $this->YachtController->store($validatedYachtData);
        $this->SkipperController->store($validatedSkipperData);


        $pier = $validatedMarinaData['pier'];
        $spotNumber = $validatedMarinaData['spotNumber'];
        $yachtRegistrationNumber = $validatedYachtData['yachtRegistrationNumber'];
        $skipperEmail = $validatedSkipperData['skipperEmail'];
        
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
        $trafficRecord = DB::table('traffic')->where('id', $recordId)->get()->first();
        $recordCreatedBy = DB::table('users')->where('id', $trafficRecord->created_by)->get()->first()->name;
        $recordUpdatedBy = DB::table('users')->where('id', $trafficRecord->updated_by)->get()->first()->name;
        
        return view('traffic.show', compact('trafficRecord','recordCreatedBy','recordUpdatedBy'));
    }

    public function checkIfExists() {
        $validatedData = request()->validate([
            'registrationNumber' => 'required',
            'skipperEmail' => 'required|email'
        ]);

        $registrationNumber = $validatedData['registrationNumber'];
        $skipperEmail = $validatedData['skipperEmail'];

        $yacht = DB::table('yachts')->where('registration_number', $registrationNumber)->get()->first();
        $skipper = DB::table('skippers')->where('email', $skipperEmail)->get()->first();

        return view('traffic.create', ['yacht' => $yacht, 'skipper' => $skipper, 'registrationNumber' => $registrationNumber, 'skipperEmail' => $skipperEmail]);
    }

    public function validatedMarinaData() {

        return request()->validate([
            'pier' => 'required|alpha',
            'spotNumber' => 'required|integer|min:0',
            'dateOfCome' => 'required',
            'dateOfLeave' => 'required|after:dateOfCome'
        ]);
    }

    private function getCurrUserId() {
        return auth()->user()->id;
    }
}
