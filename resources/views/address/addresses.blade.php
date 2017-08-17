@extends('layouts.app')
@section ('address_content')
<br/><br/>
<ol class="breadcrumb">
	<li><a href="/home"><i class="glyphicon glyphicon-home"></i></a></li>
	<li><a href="/state/{{$district->state->id}}">{{$district->state->name}}</a></li>
	<li class="active">{{$district->name}}</li>
</ol>
<a href="/state/{{$district->state->id}}" class="btn btn-primary">Go Back</a>
<h1>All Addresses in {{$district->name}}({{$district->addresses->count()}})</h1>
<a href="#editModal" data-toggle="modal" class="btn btn-primary" onclick="add_now()">&nbsp;&nbsp;Add Address&nbsp;&nbsp;</a>
<br/><br/>
<ul class="list-group">
	<li class="list-group-item">Total <span class="badge">{{$address->count()}}</span></li>
	@foreach ($address as $value)
	<div class="list-group-item">
		<sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
		<a id="name_{{$value->id}}">{{ $value->name}}</a>
		#{{$value->id}}<br/>
		{!! nl2br($value->address) !!}<br/><input type="hidden" value="{{$value->address}}" id="address_{{$value->id}}">
		<div>P.O <span id="city_{{$value->id}}">{{$value->city}}</span></div>
		<div id="district_{{$value->id}}">{{$value->district['name']}}</div>
		<input type="hidden" id="district_id_{{$value->id}}" value="{{$value->district_id}}">
		<input type="hidden" id="state_id_{{$value->id}}" value="{{$value->state_id}}">
		<div id="state_{{$value->id}}">{{$value->state['name']}}</div>
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
</ul>

<hr>
<form method="POST" action="/district/{{ $district->id }}/add-address">
	{{ csrf_field() }}
	<div class="form-group">
		Name*: <input type="text" class="form-control" name="name" value='{{ old('name') }}'>
		Address*: <textarea name="address" rows=6 class = "form-control" placeholder="Enter the address">{{ old('address') }}</textarea>
		Pin*: <input type="number" class="form-control" name="pin" min=100000 max=999999>
		P.O:<input type="text" class="form-control" name="city" placeholder="Enter Post Office">
		Phone:<input type="text" class="form-control" name="phone" placeholder="Enter Phone number">
		<br/>
		*Mandatory<br/>
		Subscription Starts : {{ Form::selectMonth('start_month',$currentMonth, array('onChange' => 'dateRangeSelect()', 'id' => 'month1')) }} {{ Form::selectRange('start_year', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelect()', 'id' => 'year1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
		Subscription Ends : {{ Form::selectMonth('end_month',$endMonth, array('id' => 'month2')) }} {{ Form::selectRange('end_year', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year2')) }}
	</div>
	<div class="form-group">
		<button type="submit" class = "btn btn-primary">Add Address</button>
	</div>
</form>

@if (count($errors))
<ul class="error">
	@foreach ($errors->all() as $error)
	<li> {{ $error }} </li>
	@endforeach
</ul>
@endif

@include('modals.edit_delete')

@stop
@section ('scripts')
@stop