@extends ('layouts.address')
@section ('address_content')
<h1>Add Addresses</h1>
<hr>
	<form method="POST" action="/add/address">
		{{ csrf_field() }}
	    <div class="form-group">
	    	Name*: <input type="text" class="form-control" name="name" value='{{ old('name') }}'>
	        Address*: <textarea name="address" rows=6 class = "form-control" placeholder="Enter the address">{{ old('address') }}</textarea>
	    	Pin*: <input type="number" class="form-control" name="pin" min=100000 max=999999>
	    	City:<input type="text" class="form-control" name="city" placeholder="Enter city name">
	    	Phone:<input type="text" class="form-control" name="phone" placeholder="Enter Phone number">
	    	<br/>
	    	
	    	*Mandatory<br/>
	    	Subscription Starts : {{ Form::selectMonth('startMonth',$currentMonth, array('onChange' => 'dateRangeSelect()', 'id' => 'month1')) }} {{ Form::selectRange('startYear', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelect()', 'id' => 'year1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
	    	Subscription Ends : {{ Form::selectMonth('endMonth',$endMonth, array('id' => 'month2')) }} {{ Form::selectRange('endYear', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year2')) }}
	    </div>
	    <div class="form-group">
	        <button type="submit" class = "btn btn-primary">Add Address</submit>
	    </div>
	</form>

	@if (count($errors))
    <ul class="error">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
	@endif
@stop