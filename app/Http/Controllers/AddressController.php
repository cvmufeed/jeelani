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
use DateTime;
use DateTimeZone;
use App\Utilities\GetAddresses;

class AddressController extends Controller
{
    public $months = ['null','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    private $currentMonth;
    private $currentYear;
    private $endMonth;

    public function __construct() {
        $this->middleware('auth');
        $this->currentMonth = date('m');
        $this->currentYear = date('Y');
        $this->endMonth = ($this->currentMonth > 1)? $this->currentMonth-1 : 12;
    }

    public function index()
    {
        $states = State::select('id','name')->pluck('name','id')->toArray();
        $districts = $this->getDistrictList();
        return view('address.add-address', ['currentMonth' => $this->currentMonth, 'currentYear' => $this->currentYear,
            'endMonth' => $this->endMonth, 'districts' => $districts,'states' => $states]);
    }
    public function district(District $district)			
    {	
        $address = Address::where('district_id','=',$district->id)->get();
        $currentMonth = $this->currentMonth;
        $currentYear = $this->currentYear;
        $month = $this->months;
        $endMonth = $this->endMonth;
        $states = State::select('id','name')->pluck('name','id')->toArray();
        $districts = $this->getDistrictList();
        return view('address.addresses', compact('address','district','month','currentMonth','currentYear','endMonth','states','districts'));
    }
    public function getDistrictList() {
        //getting district list for json output
        $districts = District::all()->groupBy('state_id')->toArray();
        $districts_json = json_encode($districts);
        return $districts_json;
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
            return back()->with('success','Successfully deleted address of:'.$address->name.' id:'.$address->id);
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
        return back()->with('Success','Successfully updated address of:'.$address->name.' id:'.$address->id);
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
        return back()->with('success','Successfully entered the Address:'.$address->name.' id:'.$address->id);
    }

    public function subscriptionMainPage()
    {   $months = $this->months;
        $subscriptions = Address::select(DB::raw('end_month,end_year,COUNT(*) AS count'))->groupBy(DB::raw('CONCAT(end_month,end_year)'))->orderBy('end_year')->orderBy('end_month')->get();
        return view('address.subscription',compact('subscriptions','months'));
    }

    
    public function addressTemplateView($address)
    {
        $currentMonth = $this->currentMonth;
        $currentYear = $this->currentYear;
        $month = $this->months;
        $endMonth = $this->endMonth;
        $states = State::select('id','name')->pluck('name','id')->toArray();
        $districts = $this->getDistrictList();
        return view('address.address-template', compact('address','month','currentMonth','currentYear','endMonth','states','districts'));
    }

    public function search(Request $request)
    {
        if ($request->search == '' && $request->option != "creation_month") {
            return back()->with('error','Enter text in search box');
        }
        $address = GetAddresses::get_search_address($request);
        if (isset($address['error'])) {
            return back()->with('error',$address['message']);
        }
        $month = $this->months;
        return $this->addressTemplateView($address);
    }
    public function subscriptionPage($subscription)
    {
        $year = $subscription%10000;
        $month = floor($subscription/10000);
        $address = Address::where([['end_month','=',$month],['end_year','=',$year]])->get();
        return $this->addressTemplateView($address);
    }
}
