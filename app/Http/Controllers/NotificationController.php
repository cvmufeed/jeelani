<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Option;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use App\Address;
use App\Log;
use DateTime;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sms_index(Request $request) {
    	$sms_number = "";
    	if ($request->has('phone')) {
    		$digits = strlen($request->phone);
    		$sms_number = ($digits == 10) ? $request->phone : "";
    	}
    	$sms_template = Option::where('name','sms_template')->first()->string_value;
    	$sms_balance = Option::where('name','sms_balance')->get()->first()->value;
    	return view('sms.index',compact('sms_template','sms_number','sms_balance'));
    }
    public function sms_send(Request $request) {
    	$sms = array("phone"=>$request->phone,"message"=>$request->message);
    	$sms_balance = Option::where('name','sms_balance')->get()->first();
    	$address_id = Address::where("phone",$request->phone)->get()->first();
    	if (($address_id == null)) {
    		$response = json_encode(array("message"=>"Address does not exist with that phone number","type"=>"error","balance"=>$sms_balance->value));	
    		return ($response);
    	}
    	// if ($this->isSMSLimitOverForThisAddress($address_id)) {
    	// 	$response = json_encode(array("message"=>"This Address message limit exhausted","type"=>"error","balance"=>$sms_balance->value));	
    	// 	return ($response);
    	// }
    	return($this->sms_processing($sms));
    }

    public function sms_processing($sms) {
        $notification = new Notification;
        $notification->recipient =  $sms["phone"];
        $notification->user_id = Auth::id();
        $notification->content = $sms["message"];
        $notification->save();
        $response = json_decode($this->sms_send_now($sms));
        $sms_balance = Option::where('name','sms_balance')->get()->first();
        if ($response->type == "success")   {
            $notification->status = 1;
            $notification->status_message = $response->message;
            $response->message = "Message successfully sent to ".$sms['phone'];
            $notification->save();
            $sms_balance->value--;
            $sms_balance->save();
        }
        $response->balance = $sms_balance->value;
        $response = json_encode($response);
        return($response);
    }
    public function sms_send_now($sms){
        // $sms['phone'] = phone_number | $sms['message'] = message
    	/*$api_call='http://my.msgwow.com/api/sendhttp.php?authkey=168854AElpsPjoHR598930c6&mobiles='.$sms['phone'].'&message='.urlencode($sms['message']).'&sender=JILANI&route=4&country=91&response=json';
    	$client = new Client();
    	$res = $client->request('GET', $api_call);
		return($res->getBody());*/
		$response = array("type"=>"success","message"=>"The sms is succesfully sent");
		//$response = array("type"=>"error","message"=>"The number is invalid");
		// sleep(3);
		return json_encode($response);
    }
    public function isSMSLimitOverForThisAddress(Address $address) {
		// First day of the month.
		$date_start = new DateTime('first day of this month');
		// Last day of the month.
		$date_end = new DateTime('last day of this month');
    	$sms_count = Notification::where([["address_id",$address->id],["status",1],["updated_at",">",$date_start],["updated_at","<",$date_end]])->get()->count();
    	$flag = ($sms_count > 2) ? true : false;
    	return $flag;
    }

    public function sendSMSForThisMonth() {
        $log
    }
}
