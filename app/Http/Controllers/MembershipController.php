<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Location;

use Illuminate\Support\Facades\Gate;

class MembershipController extends Controller
{

    public function index()
    {
        $data['members'] = Member::with(['location', 'postal'])->where('status',1)->orderBy('expire_at','asc')->get();

        if (Gate::denies('member-portal', auth()->user()) ) {
            return redirect()->route('home')->with(['status' => 'User Access Denied.', 'statusCode' => 1]);
        }

        return view('members.index', $data);
    }


    public function create(){

        if (Gate::denies('member-portal', auth()->user()) ) {
            return redirect()->route('home')->with(['status' => 'User Access Denied.', 'statusCode' => 1]);
        }

        $data['locationDropDownOptions'] = Location::all();

        return view('members.create', $data);
    }


    public function store(Request $request){

        if (Gate::denies('member-portal', auth()->user()) ) {
            return redirect()->route('home')->with(['status' => 'User Access Denied.', 'statusCode' => 1]);
        }

        $member = Member::create($request->toArray());

        return redirect()->route('membership.index')->with(['status'=>'Member Created.'  , 'statusCode'=>0]);

    }


    public function edit($id){

        if (Gate::denies('member-portal', auth()->user()) ) {
            return redirect()->route('home')->with(['status' => 'User Access Denied.', 'statusCode' => 1]);
        }

        $data['member'] = Member::with(['location', 'postal'])->find($id);

        // want to add a gate for admin only editing...
        $data['locationDropDownOptions'] = Location::all();

        return view('members.edit', $data);
    }

    public function update(Request $request, $id){

        if (Gate::denies('member-portal', auth()->user()) ) {
            return redirect()->route('home')->with(['status' => 'User Access Denied.', 'statusCode' => 1]);
        }

        try {
            $member = Member::find($id);
            foreach($member->getAttributes() as $key=>$value ){
                if ($request->has($key)){
                    $member->update([$key => ($request->input($key))] );
                }
            }
            return redirect()->route('membership.index')->with(['status'=>'Membership Updated!','statusCode' => 0]);
        } catch (\PDOException $e) {
            return redirect()->back()->with(['status' => 'Unable to Update Membership!', 'statusCode' => 1 ]);
        }
    }


    public function delete($id){

        if (Gate::denies('member-portal', auth()->user()) ) {
            return redirect()->route('home')->with(['status' => 'User Access Denied.', 'statusCode' => 1]);
        }

        $member = Member::find($id);

        $member->status = 0;
        $member->save();

        return redirect()->route('membership.index')->with(['status'=>'Membership Cancelled!','statusCode' => 0]);
    }

}
