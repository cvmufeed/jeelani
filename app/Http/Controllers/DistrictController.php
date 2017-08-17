<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\District;
use App\State;
use App\Address;

class DistrictController extends Controller
{
    public function store(Request $request, State $state)
    {
    	//Below are different methods to do the same task
    	/*$district = new District;
    	$district->name = $request->name;
    	$state->district()->save($district);*/
    	//$state->district()->save(new District(['name' => $request->name]));
    	//$state->district()->create(['name' => $request->name]);
    	//$state->district()->create($request->all());

        $this->validate($request, [
            'name' => 'required|unique:district|min:2'
        ]);

        $district = new District($request->all());
        $district->user_id = Auth::id();

  		$state->addDistrict($district);

    	return back();
    }

    public function edit(District $district)
    {
    	return view('address.edit.district', compact('district'));
    }

    public function update(Request $request, District $district)
    {
    	$district->update($request->all());
        $district->state_id = $request->state_id;
        $district->save();
    	return back()->with('message','Successfully updated district '.$district->name);
    }
    public function delete(District $district)
    {
        $addresses = Address::where('district_id','=',$district->id);
        if ($addresses->count() == 0) {
            $district->delete();
            return back();
        }
        else {
            echo 'cant delete as there is address in this district';
        }
    }
}
