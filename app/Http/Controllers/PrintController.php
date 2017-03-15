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
use PDF;
use Dompdf\Dompdf;

class PrintController extends Controller
{
	public function index()
	{
		return view('address.print');
	}
	public function test()
	{
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml('hello world');

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
		return view('address.print-view',compact('address'));
	}
}