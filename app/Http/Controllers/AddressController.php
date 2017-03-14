<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Address;
use App\Subscription;
use App\State;
use App\District;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public $months = ['null','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    private $currentMonth;
    private $currentYear;
    private $endMonth;

    public function __construct() {
        $this->currentMonth = date('m');
        $this->currentYear = date('Y');
        $this->endMonth = ($this->currentMonth > 1)? $this->currentMonth-1 : 12;
    }

    public function index()
    {
        $district = District::all();
        return $district;
        return view('address.add-address', ['currentMonth' => $this->currentMonth, 'currentYear' => $this->currentYear,
            'endMonth' => $this->endMonth]);
    }
    public function district(District $district)			
    {	
        $currentMonth = $this->currentMonth;
        $currentYear = $this->currentYear;
        $month = $this->months;
        $address = Address::where('district_id','=',$district->id)->get();
        foreach ($address as $addresses) {
             foreach($addresses->subscription as $sub) {
                $sub->startMonth = $sub->start%100;
                $sub->startYear = floor($sub->start/100)+2000;
                $sub->endMonth = $sub->end%100;
                $sub->endYear = floor($sub->end/100)+2000;
             }
        }
        $endMonth = $this->endMonth;
        return view('address.addresses', compact('address','district','month','currentMonth','currentYear','endMonth'));
    }
    public function show(Address $address)      
    {   
        return $address;
    }

    public function delete(Request $request)
    {
        if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password])) {
            // Authentication passed...
            $address = Address::find($request->delete_id);
            $address->delete();
            return back();
        }
        else {

            return back();
        }
    }
    public function update(Request $request)
    {   
        $address = Address::find($request->id);
        $address->update($request->all());
        $subscription = Subscription::where('address_id','=',$address->id);
        $subscription_start = ''.floor($request->startYear%100)*100+$request->startMonth;
        $subscription_end = ''.floor($request->endYear%100)*100+$request->endMonth;
        $subscription->update(['start' => $subscription_start, 'end' => $subscription_end]);
        return back();
    }
    public function store(Request $request, District $district)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'pin' => 'required'
            ]);
        $address = new Address($request->all());
        $address->district_id = $district->id;
        $address->state_id = $district->state_id;
        $address->user_id = Auth::id();
        $address->save();
        $subscription = new Subscription;
        $subscription->start = ''.floor($request->startYear%100)*100+$request->startMonth;
        $subscription->end = ''.floor($request->endYear%100)*100+$request->endMonth;
        $subscription->address_id = $address->id;
        $subscription->user_id = Auth::id();
        $subscription->save();
        return back();
    }

    public function search(Request $request)
    {
        if (is_numeric($request->addressee)) {
            $address = Address::find($request->addressee);
            return $address;
        }
        else {
            $address = Address::where('name','like','%'.$request->addressee.'%');
            return $address->first();          
        }
    }
}
