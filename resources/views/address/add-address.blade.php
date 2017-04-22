@extends ('layouts.address')
@section ('address_content')
<script>
	function setFormAction(value) {
		document.getElementById('form_add').action = "/district/"+value+"/add-address";
	}
</script>
<h1>Add Addresses</h1>
<hr>
	<form method="POST" id="form_add" action="/district/{{$districts[0]->id}}/add-address">
		{{ csrf_field() }}
	    <div class="form-group" id="address_form">
	    	Name*: <input type="text" class="form-control" name="name" value='{{ old('name') }}'>
	        Address*: <textarea name="address" rows=6 class = "form-control" placeholder="Enter the address">{{ old('address') }}</textarea>
	    	P.O:<input type="text" class="form-control" name="city" placeholder="Enter Post Office">
	    	Pin*: <input type="number" class="form-control" placeholder="Enter Pin Number" name="pin" min=100000 max=999999>
	    	Phone:<input type="text" class="form-control" name="phone" placeholder="Enter Phone number">
	    	District:
	    	<select name="district" class="form-control" onchange="setFormAction(this.value)">
	    		@foreach ($districts as $district)
	    			<option value="{{$district->id}}">{{$district->name}}</option>
	    		@endforeach
	    	</select>
	    	<br/>
	    	*Mandatory<br/>
	    	Subscription Starts : {{ Form::selectMonth('start_month',$currentMonth, array('onChange' => 'dateRangeSelect()', 'id' => 'month1')) }} {{ Form::selectRange('start_year', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelect()', 'id' => 'year1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
	    	Subscription Ends : {{ Form::selectMonth('end_month',$endMonth, array('id' => 'month2')) }} {{ Form::selectRange('end_year', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year2')) }}
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