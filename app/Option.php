<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Option extends Model
{
    protected $fillable = ['name','value','value_string','user_id'];
}
