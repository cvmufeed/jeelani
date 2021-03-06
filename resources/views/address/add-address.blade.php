@extends('layouts.app')
@section ('address_content')
<h1>Add Addresses</h1>
<hr>
	<form method="POST" id="form_add" action>
		{{ csrf_field() }}
	    <div class="form-group" id="address_form">
	    	Name*: <input type="text" class="form-control" name="name" value='{{ old('name') }}'>
	        Address*: <textarea name="address" rows=6 class = "form-control" placeholder="Enter the address">{{ old('address') }}</textarea>
	    	P.O:<input type="text" class="form-control" name="city" placeholder="Enter Post Office">
	    	Pin*: <input type="number" class="form-control" placeholder="Enter Pin Number" name="pin" min=100000 max=999999>
	    	Phone:<input type="text" class="form-control" name="phone" placeholder="Enter Phone number">
	    	State: {{ Form::select('state_id',$states,null,['id' => 'select_state_edit','onChange' => 'selectDistrict()','class' => 'form-control']) }}
            &nbsp;&nbsp;&nbsp;&nbsp;
            District: {{Form::select('district',[],null,array('id' => 'select_district_edit','onChange' => 'setFormAction(this.value)','class' => 'form-control'))}}
            <input type="hidden" value="{{$districts}}" id="district_list">
	    	<br/>
	    	*Mandatory<br/>
	    	Subscription Starts : {{ Form::selectMonth('start_month',$currentMonth, array('onChange' => 'dateRangeSelect()', 'id' => 'month1')) }} {{ Form::selectRange('start_year', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelect()', 'id' => 'year1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
	    	Subscription Ends : {{ Form::selectMonth('end_month',$endMonth, array('id' => 'month2')) }} {{ Form::selectRange('end_year', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year2')) }}
	    </div>
	    <div class="form-group">
	        <button type="submit" class = "btn btn-primary">Add Address</submit>
	    </div>
	</form>
	<script type="text/javascript">
		window.onload = function(){
    		document.getElementById('select_state_edit').selectedIndex = -1;
  		}
	</script>
	@if (count($errors))
    <ul class="error">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
	@endif
@stop