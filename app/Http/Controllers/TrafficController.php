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
        // $validatedData = request()->validate([
        //     'registrationNumber' => 'required',
        //     'skipperEmail' => 'required|email'
        // ]);

        // $registrationNumber = $validatedData['registrationNumber'];
        // $skipperEmail = $validatedData['skipperEmail'];

        // $yacht = DB::table('yachts')->where('registration_number', $registrationNumber)->first();
        // $skipper = DB::table('skippers')->where('email', $skipperEmail)->first();

        $avaliablePlaces = DB::table('places')
            ->where('status', '1')
            ->whereNotExists( function ($query) {
                $query->select(DB::raw(1))
                ->from('traffic')
                ->whereColumn('places.id', 'traffic.place_id');
            })
            ->orderBy('pier', 'asc')
            ->orderBy('spot_number','asc')
            ->get()
            ->all();

        // return view('traffic.create', ['yacht' => $yacht, 'skipper' => $skipper, 'registrationNumber' => $registrationNumber, 'skipperEmail' => $skipperEmail, 'avaliablePlaces' => $avaliablePlaces]);
        return view('traffic.create', ['avaliablePlaces' => $avaliablePlaces]);
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

        $yacht = DB::table('yachts')->where('registration_number', $yachtRegistrationNumber)->first();
        $skipper = DB::table('skippers')->where('email', $skipperEmail)->first();

        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();

        DB::table('traffic')->insertGetId([
            'place_id' => $validatedMarinaData['place'],
            'date_of_come' => $validatedMarinaData['dateOfCome'],
            'date_of_leave' => $validatedMarinaData['dateOfLeave'],
            'yacht_id' => $yacht->id,
            'skipper_id' => $skipper->id,
            'created_by' => $currUserId,
            'updated_by' => $currUserId,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        return redirect()->route('trafficIndex');   
    }

    public function show($recordId) {
        $trafficRecord = DB::table('traffic')->where('id', $recordId)->first();
        $pier = DB::table('places')->where('id', $trafficRecord->place_id)->first()->pier;
        $spotNumber = DB::table('places')->where('id', $trafficRecord->place_id)->first()->spot_number;

        $place = $pier.$spotNumber;
        $yachtName = DB::table('yachts')->select('name')->where('id', $trafficRecord->yacht_id)->first();
        $skipperName = DB::table('skippers')->select('name')->where('id', $trafficRecord->skipper_id)->first();
        $skipperSurname = DB::table('skippers')->select('surname')->where('id', $trafficRecord->skipper_id)->first();
        $recordCreatedBy = DB::table('users')->select('name')->where('id', $trafficRecord->created_by)->first();
        $recordUpdatedBy = DB::table('users')->select('name')->where('id', $trafficRecord->updated_by)->first();
        
        return view('traffic.show', compact('trafficRecord','recordCreatedBy','recordUpdatedBy','place','yachtName','skipperName','skipperSurname'));
    }

    public function archive($recordId) {
        $recordToArchive = DB::table('traffic')->where('id', $recordId)->first();
        $place = DB::table('places')->where('id',$recordToArchive->place_id)->first();
        $yacht = DB::table('yachts')->where('id',$recordToArchive->yacht_id)->first();
        $skipper = DB::table('skippers')->where('id',$recordToArchive->skipper_id)->first();
        $now = Carbon::now();
        $currUserId = $this->getCurrUserId();
        
        DB::table('traffic_history')->insertGetId([
            'pier' => $place->pier,
            'spot_number' => $place->spot_number,
            'date_of_come' => $recordToArchive->date_of_come,
            'date_of_leave' => $recordToArchive->date_of_leave,
            'yacht_name' => $yacht->name,
            'yacht_registration_number' => $yacht->registration_number,
            'yacht_type' => $yacht->type, 
            'yacht_length' => $yacht->length,
            'yacht_owner' => $yacht->owner,
            'skipper_name' => $skipper->name,
            'skipper_surname' => $skipper->surname,
            'skipper_personal_id_number' => $skipper->personal_id_number,
            'skipper_country' => $skipper->country,
            'skipper_email' => $skipper->email,
            'created_by' => $recordToArchive->created_by,
            'updated_by' => $recordToArchive->updated_by,
            'archived_by' => $currUserId,
            'archived_at' => $now,
            'created_at' => $recordToArchive->created_at,
            'updated_at' => $recordToArchive->updated_at,
        ]);

        DB::table('traffic')->where('id', $recordId)->delete();

        return redirect()->route('trafficIndex'); 
    }

    public function showHistory() {
        $archivedRecords = DB::table('traffic_history')->get()->all();
        $users = DB::table('users')->select('id','name')->get()->all();

        return view('traffic.history', compact('archivedRecords', 'users'));
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
