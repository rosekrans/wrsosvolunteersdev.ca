<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shift extends Model
{
    protected $fillable = ['user_detail_id', 'shift_type_id', 'shift_start', 'shift_end'];

    public function userDetail(){
        return $this->belongsTo('App\Models\UserDetail');
    }

    public function shiftType(){
        return $this->hasOne('App\Models\ShiftType','id', 'shift_type_id' );
    }

    public function setShiftStartAttribute($value)
    {        
        if (!is_null($value)){
           
            $this->attributes['shift_start'] = Carbon::createFromFormat('m/d/Y h:i a', $value);
        } 
                
    }

    public function setShiftEndAttribute($value)
    {
        if (!is_null($value)){
            $this->attributes['shift_end'] = Carbon::createFromFormat('m/d/Y h:i a', $value);
        }
    }
}
