<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_name', 'email', 'status', 'last_login', 'password', 'isAdmin'
    ];

    protected $hidden = [
         'remember_token', 'isAdmin', 'password', 'isMembership'
    ];

    public function sendPasswordResetNotification($token){
        $this->notify(new PasswordReset($token));
    }

    public function isAdmin()
    {
        return $this->isAdmin; // this looks for an admin column in your users table
    }

    public function isMembership()
    {
        return $this->isMembership;
    }

    public function isActive()
    {
        if ($this->status <= 2){
            return true;
        } else {
            return false;
        }

    }

    public function userDetail(){
        return $this->hasOne('App\Models\UserDetail');
    }

    public function statusCode(){
        return $this->hasOne('App\Models\StatusCode', 'id', 'status' );
    }





}
