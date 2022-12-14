<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserDetail extends Model
{
    protected $fillable = ['first_name',
        'last_name',
        'location_id',
        'postal_code_id',
        'home_number',
        'cell_number',
        'other_number',
        'notes',
        'availability',
        'rabies_vaccine',
        'hotline_mentor',
        'rescue_mentor',
		'catch_pole',
		'waiver_complete',
        'management_position',
        'board_position',
        'rehab_center',
        'vet_clinic'
    ];
    //protected $guarded = ['id', 'user_id'];

    public function location(){
        return $this->hasOne('App\Models\Location','id', 'location_id' );
    }

    public function shifts(){
        return $this->hasMany('App\Models\Shift')->orderBy('shift_start', 'asc');
    }

    public function role(){
        return $this->hasOne('App\Models\Role');
    }

    public function postalCode(){
        return $this->hasOne('App\Models\PostalCode','id', 'postal_code_id' );
    }

}
