@extends('layouts.app')
@section ('address_content')


<ul class="list-group">
	<li class="list-group-item">Total <span class="badge">{{$address->count()}}</span></li>
	    @foreach ($address as $value)
	    	<div class="list-group-item">
	    		<sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
	    		<a id="name_{{$value->id}}">{{ $value->name}}</a>
	    		#{{$value->id}}<br/>
	    		{!! nl2br($value->address) !!}<br/><input type="hidden" value="{{$value->address}}" id="address_{{$value->id}}">
		        P.O <span id="city_{{$value->id}}">{{$value->city}}</span><br/>
		        <div id="district_{{$value->id}}">{{$value->district->name}}</div>
		        <input type="hidden" id="district_id_{{$value->id}}" value="{{$value->district_id}}">
		        <input type="hidden" id="state_id_{{$value->id}}" value="{{$value->state_id}}">
		        <div id="state_{{$value->id}}">{{$value->state->name}}</div>
		        Phone: <span id="phone_{{$value->id}}">{{$value->phone}}</span><br/>
		        Pin: <span id="pin_{{$value->id}}">{{$value->pin}}</span><br/>
		        From: {{$month[$value->start_month]}}-{{$value->start_year}}<input type="hidden" id="start_month_{{$value->id}}" value="{{$value->start_month}}"><input type="hidden" id="start_year_{{$value->id}}" value="{{$value->start_year}}">
		        To: {{$month[$value->end_month]}}-{{$value->end_year}}<input type="hidden" id="end_month_{{$value->id}}" value="{{$value->end_month}}"><input type="hidden" id="end_year_{{$value->id}}" value="{{$value->end_year}}">
		        <a href="#editModal" data-toggle="modal" onclick="editNow({{$value->id}})">edit</a>&nbsp;&nbsp;
		        <a href="#deleteModal" data-toggle="modal" onclick="deleteNow({{$value->id}})">delete</a>
		        <a href="/print/address/{{$value->id}}" class="pull-right"><i class="glyphicon glyphicon-print"></i></a>
		        <a href="/sms?phone={{$value->phone}}" class="pull-right" style="margin-right: 10px;"><i class="glyphicon glyphicon-envelope"></i></a>
	        </div>
	    @endforeach
	    @if ($address->count() == 0)
	    <li class="list-group-item">Sorry... :( No Address...</li>
	    @endif
</ul>


@include('modals.edit_delete')

@stop
@section ('scripts')

@stop