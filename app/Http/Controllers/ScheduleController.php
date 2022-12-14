<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\ShiftType;
use App\Models\Shift;
use App\Models\UserDetail;
use Carbon\Carbon;

use App\Http\Requests\UpdateShift;

class ScheduleController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        dd($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(UpdateShift $request, $id)
    {

        $user_details = UserDetail::find($id);
        $user_details->availability = $request['availability'];
        $user_details->save();

        $date = new Carbon();
        $startDate = new Carbon($request['startDate']);
        $endDate = new Carbon($request['endDate']);

        if (!($startDate < $date) || !($endDate < $date)) {
            try {
                $shift = Shift::create([
                    'user_detail_id' => $id,
                    'shift_type_id' => $request['shift_type_id'],
                    'shift_start' => $request['startDate'],
                    'shift_end' => $request['endDate']
                ]);

                $shifts = Shift::with('shiftType')
                    ->where('user_detail_id', $id)
                    ->where('shift_start', '>', Carbon::now()->subDays(7))
                    ->orderBy('shift_start', 'asc')->get();

                return Response::json(['status' => 'Shift Scheduled.', 'statusCode' => 0, 'shifts' => $shifts->toArray() ]);

            } catch (\PDOException $e) {

                $shifts = Shift::with('shiftType')
                    ->where('user_detail_id', $id)
                    ->where('shift_start', '>', Carbon::now()->subDays(7))
                    ->orderBy('shift_start', 'asc')->get();

                return Response::json(['status' => 'Shift Already Scheduled.', 'statusCode' => 1, 'shifts' => $shifts->toArray() ]);
            }
        } else {

            $shifts = Shift::with('shiftType')
                ->where('user_detail_id', $id)
                ->where('shift_start', '>', Carbon::now()->subDays(7))
                ->orderBy('shift_start', 'asc')->get();

            return Response::json(['status' => 'Cannot schedule shift in the past. Today:' . $date .' Start date: ' . $startDate . ' End date:  ' .  $endDate  , 'statusCode' => 1, 'shifts' => $shifts->toArray() ]);
        }
    }

    public function destroy($id)
    {
        $shift = Shift::find($id);
        $shift->delete();
        return Response::json(['status' => 'Shift Scheduled.', 'statusCode' => 0]);
    }
}
