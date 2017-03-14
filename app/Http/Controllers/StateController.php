<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Address;
use App\State;
use App\District;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    public function index()
    {
    	$state = State::all();
    	return view('address.index', compact('state'));
    }
    public function state(State $state)			
    {		
    	$state->load('district.user');
    	//$state =  State::with('district.user')->find($state->id);
    	return view('address.state', compact('state'));
    }

    public function store(Request $request)			
    {
    	$this->validate($request, [
            'name' => 'required|unique:state|min:2'
        ]);
    	$state = new State($request->all());
    	$state->user_id = Auth::id();
    	$state->save();
    	return back();
    }
    public function delete(State $state)
    {
    	$district = District::where('state_id','=',$state->id);
    	if ($district->count() == 0 ) {

    		$state->delete();
    		return back();
    	}
    	else {
    		echo 'Cannot delete state As there are districts under this state. To delete the state delete all the Districts first.';
    	}
    }
}
