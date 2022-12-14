<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use App\Models\Location;
use App\Models\StatusCode;

class AdministrativeController extends Controller
{
    public function index()
    {
        $data['volunteers'] = User::with(['userDetail.location', 'userDetail.role'])->get();

        return view('contacts.administrative.index', $data);
    }
}
