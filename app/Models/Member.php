<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'location_id',
        'postal_id',
        'phone_number',
        'expire_at',
        'payment_at',
        'notes',
        'complementary',
        'status',
        'created_at',
        'updated_at'];

    public function location(){
        return $this->hasOne('App\Models\Location','id', 'location_id' );
    }

    public function postal(){
        return $this->hasOne('App\Models\PostalCode','id', 'postal_id' );
    }

}
