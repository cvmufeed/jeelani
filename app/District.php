<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    protected $fillable = [
        'name','user_id'
    ];

    public function state()
    {
    	return $this->belongsTo(State::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function deleteDistrict()      
    {
        return 'hi';
    }

}