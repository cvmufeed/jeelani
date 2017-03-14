<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function district()
    {
        return $this->hasMany(District::class);
    }
    public function state()
    {
        return $this->hasMany(State::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}
