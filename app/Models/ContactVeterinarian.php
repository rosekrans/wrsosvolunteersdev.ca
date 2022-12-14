<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactVeterinarian extends Model
{
    protected $fillable = [
        'clinic_name',
        'contact_name', 
        'number', 
        'location_id', 
        'address', 
        'website', 
        'email', 
        'hours', 
        'notes'
        ];

    public function location(){
        return $this->hasOne('App\Models\Location','id', 'location_id' );
    }

}
