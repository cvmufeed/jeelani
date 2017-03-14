<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	protected $fillable = ['start','end'];

    public function address()
    {
    	return $this->belongsTo(Address::class);
    }
}
