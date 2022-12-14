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
use App\Models\Call;
use App\Models\CallActivity;
use App\Models\Shift;
use App\Models\ShiftType;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['calls'] = Call::with('location',
            'species',
            'solutionType',
            'responderType',
            'contactRehabilitator',
            'contactVeterinarian',
            'callActivity.userDetail')
            ->where('call_status','Open')
            ->get();

        $data['hotlineShifts'] = Shift::with('shiftType', 'userDetail', 'userDetail.location')
            ->where('shift_type_id', 1)
            ->where('shift_start', '>', Carbon::now()->subDays(30))
            ->get();

		$data['oncallShifts'] = Shift::with('shiftType', 'userDetail', 'userDetail.location')
            ->where('shift_type_id', 3)
            ->where('shift_start', '>', Carbon::now()->subDays(30))
            ->get();
		
        $data['rescueShifts'] = Shift::with('shiftType', 'userDetail', 'userDetail.location')
        ->where('shift_type_id', 2)
        ->where('shift_start', '>', Carbon::now()->subDays(30))
        ->get();

        return view('home', $data);
    }
}
