<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

	protected $fillable = [
		'name','address','pin','state_id','district_id','phone','city','start_month','start_year','end_month','end_year'
	];

    public function district()
    {
    	return $this->belongsTo(District::class);
    }

    public function state()
    {
    	return $this->belongsTo(State::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }

}