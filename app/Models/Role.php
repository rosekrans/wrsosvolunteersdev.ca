<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'hotline',
        'rescue',
        'transport',
        'event',
        'fundraising',
        'management',
        'board',
        'rehabilitator',
        'veterinarian'
    ];

    public function userDetail(){
        return $this->belongsTo('App\Models\UserDetail');
    }
}
