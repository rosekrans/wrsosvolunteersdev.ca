<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRehabilitator extends Model
{
    protected $fillable = [
        'center_name', 
        'contact_name',
        'number', 
        'location_id', 
        'address', 
        'website', 
        'email', 
        'species_notes', 
        'notes'
        ];

    public function location(){
        return $this->hasOne('App\Models\Location','id', 'location_id' );
    }
}
