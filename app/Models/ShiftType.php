<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftType extends Model
{
    public function shift(){
        return $this->belongsTo('App\Models\Shift');
    }
}
