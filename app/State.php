<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state';

    protected $fillable = ['name','user_id'];

    public function district()
    {
        return $this->hasMany(District::class);
    }

    public function addDistrict(District $district)
    {
    	return $this->district()->save($district);
    }

    public function addresses()
    {
        return $this->hasMany('App\Address','state_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
