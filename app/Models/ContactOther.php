<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactOther extends Model
{
    protected $fillable = [
        'contact_type_id', 
        'contact_name',
        'location_id', 
        'contact_number', 
        'email', 
        'notes'
        ];

    public function location(){
        return $this->hasOne('App\Models\Location','id', 'location_id' );
    }

    public function contactType(){
        return $this->hasOne('App\Models\ContactType', 'id', 'contact_type_id' );
    }
}
