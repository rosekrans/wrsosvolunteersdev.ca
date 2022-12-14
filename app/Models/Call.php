<?php

namespace App\Models;

use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'call_type_id',
        'open_date',
        'call_status',
        'close_date',
        'caller_first_name',
        'caller_last_name',
        'caller_phone_number',
        'caller_location_id',
        'caller_postal_code_id',
        'caller_address',
		'caller_thanks',
        'caller_notes',
        'animal_species_id',
        'animal_situation',
        'animal_solution_type_id',
        'animal_solution',
        'animal_responder_type_id',
        'rehabilitator_id',
        'veterinarian_id'
        ];

    public function setOpenDateAttribute($value)
    {

        if (!is_null($value)){

            $this->attributes['open_date'] = Carbon::createFromFormat('m/d/Y h:i a', $value);
        }

    }

    public function setCloseDateAttribute($value)
    {
        if (!is_null($value)){
            $this->attributes['close_date'] = Carbon::createFromFormat('m/d/Y h:i a', $value);
        }
    }

    public function location(){
        return $this->hasOne('App\Models\Location','id', 'caller_location_id' );
    }
    public function species(){
        return $this->hasOne('App\Models\Species','id', 'animal_species_id' );
    }
    public function solutionType(){
        return $this->hasOne('App\Models\SolutionType','id', 'animal_solution_type_id' );
    }
    public function responderType(){
        return $this->hasOne('App\Models\ResponderType','id', 'animal_responder_type_id' );
    }
    public function contactRehabilitator(){
        return $this->hasOne('App\Models\ContactRehabilitator','id', 'rehabilitator_id' );
    }
    public function contactVeterinarian(){
        return $this->hasOne('App\Models\ContactVeterinarian','id', 'veterinarian_id' );
    }

    public function callActivity(){
        return $this->hasMany('App\Models\CallActivity');
    }

    public function postalCode(){
        return $this->hasOne('App\Models\PostalCode','id', 'caller_postal_code_id' );
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function($table)  {
            $table->updated_by = Auth::user()->user_name;
        });


    }

}
