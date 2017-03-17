<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Option;

class OptionController extends Controller
{
    public function setOptions(Request $request)
    {
    	$options = Option::all();
    	$option = $options->where('name','page_width')->first();
    	$option->value = $request->page_width;
    	$option->save();
    	$option = $options->where('name','page_height')->first();
    	$option->value = $request->page_height;
    	$option->save();
    	$option = $options->where('name','address_width')->first();
    	$option->value = $request->address_width;
    	$option->save();
    	$option = $options->where('name','address_margin_top')->first();
    	$option->value = $request->address_margin_top;
    	$option->save();
    	$option = $options->where('name','address_font_size')->first();
    	$option->value = $request->address_font_size;
    	$option->save();
    	return back();
    }
}
