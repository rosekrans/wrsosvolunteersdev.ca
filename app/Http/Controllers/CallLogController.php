<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use App\Models\ContactVeterinarian as Veterinarian;
use App\Models\ContactRehabilitator as Rehabilitator;
use App\Models\Location;
use App\Models\CallType;
use App\Models\ResponderType;
use App\Models\SolutionType;
use App\Models\PostalCode;
use App\Models\Call;
use App\Models\CallActivity;
use App\Http\Requests\StoreCallLog;
use App\Http\Requests\UpdateCallLog;
use Auth;

class CallLogController extends Controller
{
    public function index() {
        $data['recordCount'] = (Input::get('recordCount', 25));
        $data['calls'] = Call::with('location', 'species', 'solutionType', 'responderType', 'contactRehabilitator', 'contactVeterinarian', 'callActivity.userDetail')
            ->orderBy('call_status', 'desc') //to get open first
            ->orderBy('open_date', 'desc') // date newest to oldest
            ->paginate($data['recordCount']);

        return view('call_log.index', $data);
    }

    public function create(){
        $data['callTypeDropDownOptions'] = CallType::all();
        $data['veterinarianDropDownOptions'] = Veterinarian::orderBy('clinic_name', 'asc')->get();
        $data['rehabilitatorDropDownOptions'] = Rehabilitator::orderBy('center_name', 'asc')->get();
        $data['responderTypeDropDownOptions'] = ResponderType::orderBy('responder_type', 'asc')->get();
        $data['solutionTypeDropDownOptions'] = SolutionType::orderBy('solution_type', 'asc')->get();
        $data['locationDropDownOptions'] = Location::orderBy('location', 'asc')->get();
        return view('call_log.create', $data);
    }

    public function store(StoreCallLog $request)
    {
        $call = Call::create($request->toArray());
        $call->created_by = Auth::user()->user_name;
        $call->save();

        $hotline_volunteers = json_decode($request->volunteer_hotline);

        if( isset($hotline_volunteers)){
            foreach ($hotline_volunteers as $key=>$value){
                $activity = new CallActivity();
                $activity->call_id = $call->id;
                $activity->user_detail_id = $key;
                $activity->activity_type_id = 1;
                $activity->save();
            }
        }

        $rescue_volunteers = json_decode($request->volunteer_rescue);

        if( isset($rescue_volunteers)){
            foreach ($rescue_volunteers as $key=>$value){
                $activity = new CallActivity();
                $activity->call_id = $call->id;
                $activity->user_detail_id = $key;
                $activity->activity_type_id = 2;
                $activity->save();
            }
        }


        return redirect()->route('call_log.index')->with(['status'=>'Call Created.' , 'statusCode'=>0]);
    }

    public function edit($id)
    {

        $data['call_log'] = Call::with('species', 'callActivity.userDetail')->find($id);
        $data['callTypeDropDownOptions'] = CallType::all();
        $data['veterinarianDropDownOptions'] = Veterinarian::orderBy('clinic_name', 'asc')->get();
        $data['rehabilitatorDropDownOptions'] = Rehabilitator::orderBy('center_name', 'asc')->get();
        $data['responderTypeDropDownOptions'] = ResponderType::orderBy('responder_type', 'asc')->get();
        $data['solutionTypeDropDownOptions'] = SolutionType::orderBy('solution_type', 'asc')->get();
        $data['locationDropDownOptions'] = Location::orderBy('location', 'asc')->get();


        return view('call_log.edit', $data);
    }

    public function update(UpdateCallLog $request, $id)
    {
        try {
            $call = Call::find($id);
            foreach($call->getAttributes() as $key=>$value ){
                if ($request->has($key)){
                    $call->update([$key => ($request->input($key))] );
                }
            }

            $call->callActivity()->delete();

            $hotline_volunteers = json_decode($request->volunteer_hotline);

            if( isset($hotline_volunteers)){

                foreach ($hotline_volunteers as $key=>$value){
                    $activity = new CallActivity();
                    $activity->call_id = $id;
                    $activity->user_detail_id = $key;
                    $activity->activity_type_id = 1;
                    $activity->save();
                }
            }

            $rescue_volunteers = json_decode($request->volunteer_rescue);

            if( isset($rescue_volunteers)){

                foreach ($rescue_volunteers as $key=>$value){
                    $activity = new CallActivity();
                    $activity->call_id = $id;
                    $activity->user_detail_id = $key;
                    $activity->activity_type_id = 2;
                    $activity->save();
                }
            }

            return redirect()->route('call_log.index')->with(['status'=>'Call Updated.' , 'statusCode'=>0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Update Call!', 'statusCode' => 1 ]);
        }
    }

    public function delete($id){
        try {
            $call = Call::find($id);
            $call->callActivity()->delete();
            $call->delete();
            return redirect()->route('call_log.index')->with(['status'=>'Call Deleted.' , 'statusCode'=>0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Delete Call!', 'statusCode' => 1 ]);
        }
    }

    public function searchSpecies($term){

        $search = DB::select("SELECT id, species_name FROM wrsosvolunteersdev_ca.species WHERE species_name LIKE '%".$term. "%' ORDER BY 2 ASC");
        return Response::json($search);
    }

    public function searchVolunteers($term){

        $search = DB::select("SELECT id, concat(first_name,' ', last_name) as Name FROM wrsosvolunteersdev_ca.user_details WHERE concat(first_name,' ', last_name) LIKE '%".$term. "%' ORDER BY 1 ASC");
        return Response::json($search);
    }

    public function getClosestVolunteers() {
        $postal_code_id = $request->postal_code_id;

        if( isset($postal_code_id) ) {
            $postal = PostalCode::find($postal_code_id);

        }
    }
}
