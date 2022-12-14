<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallActivity extends Model
{
    public function activityType(){
        return $this->hasOne('App\Models\ActivityType','id', 'activity_type_id' );
    }

    public function userDetail(){
        return $this->belongsTo('App\Models\UserDetail');
    }

}
