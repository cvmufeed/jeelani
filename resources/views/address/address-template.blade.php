@extends ('layouts.address')
@section ('address_content')
<ul class="list-group">
<li class="list-group-item">Total <span class="badge">{{$address->count()}}</span></li>
	    @foreach ($address as $value)
	    	<div class="list-group-item">
	    		<sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
	    		<a href="/address/{{ $value->id }}"/ id="name_{{$value->id}}">{{ $value->name}}</a>
	    		#{{$value->id}}<br/>
	    		{!! nl2br($value->address) !!}<br/><input type="hidden" value="{{$value->address}}" id="address_{{$value->id}}">
		        <div id="city_{{$value->id}}">{{$value->city}}</div>
		        <div id="district_{{$value->id}}">{{$value->district->name}}</div>
		        <div id="state_{{$value->id}}">{{$value->state->name}}</div>
		        Phone: <span id="phone_{{$value->id}}">{{$value->phone}}</span><br/>
		        Pin: <span id="pin_{{$value->id}}">{{$value->pin}}</span><br/>
		        From: {{$month[$value->start_month]}}-{{$value->start_year}}<input type="hidden" id="start_month_{{$value->id}}" value="{{$value->start_month}}"><input type="hidden" id="start_year_{{$value->id}}" value="{{$value->start_year}}">
		        To: {{$month[$value->end_month]}}-{{$value->end_year}}<input type="hidden" id="end_month_{{$value->id}}" value="{{$value->end_month}}"><input type="hidden" id="end_year_{{$value->id}}" value="{{$value->end_year}}">
		        <a href="/print/address/{{$value->id}}" class="pull-right"><i class="glyphicon glyphicon-print"></i></a>
	        </div>
	    @endforeach
	    @if ($address->count() == 0)
	    <li class="list-group-item">Sorry... :( No Address...</li>
	    @endif
</ul>
@stop