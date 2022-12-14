<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use Auth;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use App\Models\Location;
use App\Models\StatusCode;
use App\Models\Shift;
use App\Models\ShiftType;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function index(){
        $data['volunteers'] = User::with(['userDetail.location', 'userDetail.role'])->get();

        return view('contacts.volunteer.index', $data);
    }


    public function create(){

        $data['locationDropDownOptions'] = Location::all();
        $data['statusCodeDropDownOptions'] = StatusCode::all();
        $data['shiftTypeDropDownOptions'] = ShiftType::all();

        return view('profile.create', $data);
    }

    public function store(Request $request){

        $this->validate($request, [
            'user_name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        $tempPassword = $this->generateRandomString();

        $user = User::create([
            'user_name' => $request['user_name'],
            'email' => $request['email'],
            'password' => bcrypt($tempPassword),
            'isAdmin' => $request['isAdmin'],
            'status' =>$request['status'],
        ]);

        $userDetail = $user->userDetail()->create($request->toArray());
        $role = $userDetail->role()->create($request->toArray());

        return redirect()->route('volunteer.index')->with(['status'=>'User Created with id: ' . $user->user_name , 'statusCode'=>0]);

    }


    public function show($id){
        $data['user'] = User::with(['userDetail', 'userDetail.role'])
            ->find($id);

        $data['shifts'] = Shift::with('shiftType')->where('user_detail_id', $data['user']['userDetail']->id)
            ->where('shift_start', '>', Carbon::now()->subDays(30))
            ->orderBy('shift_start','asc')
            ->get();


        $data['locationDropDownOptions'] = Location::all();
        $data['shiftTypeDropDownOptions'] = ShiftType::all();
        $data['statusCodeDropDownOptions'] = StatusCode::all();


        return view('profile.show', $data);
    }

    public function edit($id){

        $data['user'] = User::with(['userDetail', 'userDetail.role', 'userDetail.postalCode'])
            ->find($id);

        $data['shifts'] = Shift::with('shiftType')->where('user_detail_id', $data['user']['userDetail']->id)
            ->where('shift_start', '>', Carbon::now()->subDays(30))
            ->orderBy('shift_start','asc')
            ->get();

        if(Gate::denies('profile-edit', $data['user'])){
            return redirect()->back();
        }

        $data['locationDropDownOptions'] = Location::all();
        $data['shiftTypeDropDownOptions'] = ShiftType::all();
        $data['statusCodeDropDownOptions'] = StatusCode::all();

        return view('profile.edit', $data);
    }


    public function update(Request $request, $id){

        try {
            $user = User::find($id);
            foreach($user->getAttributes() as $key=>$value ){
                if ($request->has($key)){
                    $user->update([$key => ($request->input($key))] );
                }
            }

            $userDetail = UserDetail::where('user_id',$id)->first();
            foreach($userDetail->getAttributes() as $key=>$value ){
                if ($request->has($key)){
                    $userDetail->update([$key => ($request->input($key))] );
                }
            }

            $roles = Role::where('user_detail_id', $userDetail->id)->first();
            foreach($roles->getAttributes() as $key=>$value ){
                if ($request->has($key)){
                    $roles->update([$key => ($request->input($key))] );
                }
            }

            return redirect()->route('volunteer.index')->with(['status'=>'Volunteer Contact Updated!','statusCode' => 0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Update User!', 'statusCode' => 1 ]);
        }

    }


    public function delete($id){

        $user = User::find($id);

        $user->delete();

        return redirect()->back()->with(['status'=>'Volunteer Contact Deleted!','statusCode' => 0]);
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function searchPostalCodes($term){

        $search = DB::select("SELECT id, postal_code FROM wrsosvolunteersdev_ca.postal_codes WHERE postal_code LIKE '%".$term. "%' ORDER BY 1 ASC");
        return Response::json($search);
    }
}
