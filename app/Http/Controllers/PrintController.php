<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Address;
use App\State;
use App\District;
use App\Option;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PDF;
use Dompdf\Dompdf;

class PrintController extends Controller
{
	public function index()
	{
		return view('address.print');
	}
	public function download()
	{
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$address = Address::all();
		$dompdf->loadHtml(view('address.print-view',compact('address')));

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}
	public function all()
	{
		$address = Address::all();
		return $this->passPrintToView($address);
	}
	public function printAddress($address)
	{
		$id = $address;
		$address = Address::where('id',$id)->get();
		return $this->passPrintToView($address);
	}
	public function printDistrict($district)
	{
		$address = Address::where('district_id',$district)->get();
		return $this->passPrintToView($address);
	}
	public function printState($state)
	{
		$address = Address::where('state_id',$state)->get();
		return $this->passPrintToView($address);
	}
	public function printSubscription($subscription)
	{
		$year = $subscription%10000;
        $month = floor($subscription/10000);
        $address = Address::where([['end_month','=',$month],['end_year','=',$year]])->get();
        return $this->passPrintToView($address);
	}
	public function passPrintToView($address) {
		$options = Option::all();
		$address = $address->reject(function ($item) { 
			$collection_year_month = $item->end_year*100+$item->end_month;
			$reject_year_month=date('Y')*100+date('m'); 
			if ($collection_year_month < $reject_year_month) 
			{
				return $item;
			} 
		});
		return view('address.print-view',compact('address','options'));
	}
}