<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sms_index() {
    	 return view('sms.index');
    }

    public function sms_send(Request $request) {
    	$api_call='http://my.msgwow.com/api/sendhttp.php?authkey=168854AElpsPjoHR598930c6&mobiles='.$request->phone.'&message='.urlencode($request->message).'&sender=JILANI&route=4&country=91&response=json';
    	$json = array("status"=>"OK","number"=>$request->phone,"message"=>$request->message,"link"=>$api_call);
    	return($json);
    }
}
