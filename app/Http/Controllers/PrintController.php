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
		$options = Option::all();
		$address = Address::all();
		return view('address.print-view',compact('address','options'));
	}
	public function printAllNow()
	{
		$options = Option::all();
		$address = Address::all();
		$todo = 'download';
		return view('print.template',compact('options','address','todo'));
	}
	public function printAddress($address)
	{
		$id = $address;
		$address = Address::where('id',$id)->get();
		$options = Option::all();
		return view('address.print-view',compact('address','options'));
	}
	public function printDistrict($district)
	{
		$address = Address::where('district_id',$district)->get();
		$options = Option::all();
		return view('address.print-view',compact('address','options'));
	}
	public function printState($state)
	{
		$address = Address::where('state_id',$state)->get();
		$options = Option::all();
		return view('address.print-view',compact('address','options'));
	}
}