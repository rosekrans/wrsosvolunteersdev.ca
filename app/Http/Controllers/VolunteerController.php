<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use App\Models\Location;
use App\Models\StatusCode;

class VolunteerController extends Controller
{

    public function index()
    {
        $data['volunteers'] = User::with(['userDetail.location', 'userDetail.role', 'statusCode'])->orderBy('status','asc')->orderBy('user_name','asc')->get();

        
        return view('contacts.volunteer.index', $data);
    }

}
