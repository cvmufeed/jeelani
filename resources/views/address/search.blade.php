@extends ('layouts.address')
@section ('address_content')

<script>
function deleteNow(value) {
	document.getElementById('deleteValue').value = value;
}
function editNow(value) {
	var form = document.forms['edit_form'];
	form.elements['name'].value = document.getElementById('name_'+value).innerHTML;
	form.elements['address'].innerHTML = document.getElementById('address_'+value).value;
	form.elements['city'].value = document.getElementById('city_'+value).innerHTML;
	form.elements['phone'].value = document.getElementById('phone_'+value).innerHTML;
	form.elements['pin'].value = document.getElementById('pin_'+value).innerHTML;
	form.elements['id'].value = value;
}
</script>

	<h1>Search Results...</h1>
	<a href = "/add/address" class="btn btn-primary">&nbsp;&nbsp;Add Address&nbsp;&nbsp;</a>
	<ul class="list-group">
	    @foreach ($address as $value)
	    	<div class="list-group-item">
	    		<sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
	    		<a href="/address/{{ $value->id }}"/ id="name_{{$value->id}}">{{ $value->name}}</a>
	    		#{{$value->id}}<br/>
	    		{!! nl2br($value->address) !!}<br/><input type="hidden" value="{{$value->address}}" id="address_{{$value->id}}">
		        <div id="district_{{$value->id}}">{{$value->district->name}}</div>
		        <div id="state_{{$value->id}}">{{$value->state->name}}</div>
		        P.O: <span id="city_{{$value->id}}">{{$value->city}}</span><br/>
		        Phone: <span id="phone_{{$value->id}}">{{$value->phone}}</span><br/>
		        Pin: <span id="pin_{{$value->id}}">{{$value->pin}}</span><br/>
		        From: {{$month[$value->subscription[0]->startMonth]}}-{{$value->subscription[0]->startYear}}
		        To: {{$month[$value->subscription[0]->endMonth]}}-{{$value->subscription[0]->endYear}}
		        <a href="#editModal" data-toggle="modal" onclick="editNow({{$value->id}})">edit</a>&nbsp;&nbsp;
		        <a href="#deleteModal" data-toggle="modal" onclick="deleteNow({{$value->id}})">delete</a>
	        </div>
	    @endforeach
	</ul>

	<hr>

	@if (count($errors))
    <ul class="error">
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
	@endif

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Enter password to delete</h4>
	        </div>
	        <div class="modal-body">
	          <form action="/address/delete" method="POST">
	          	{{csrf_field()}}
	          	<input type="password" name="password" placeholder="password">
	          	<input type="submit" class="btn btn-primary" value="Submit">
	          	<input type="hidden" name="delete_id" value="" id="deleteValue">
	          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>
  <div class="modal fade" id="editModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Address</h4>
	        </div>
	        <div class="modal-body">
				<form method="POST" action="/address/edit" id="edit_form">
					{{ csrf_field() }}
					{{ method_field('patch') }}
				    <div class="form-group">
				    	Name*: <input type="text" class="form-control" name="name" value="">
				        Address*: <textarea name="address" rows=6 class = "form-control" placeholder="Enter the address"></textarea>
				    	Pin*: <input type="number" class="form-control" name="pin" min=100000 max=999999>
				    	City:<input type="text" class="form-control" name="city" placeholder="Enter city name">
				    	Phone:<input type="text" class="form-control" name="phone" placeholder="Enter Phone number">
				    	<br/>
				    	<input type="hidden" name="id" value="">
				    	*Mandatory<br/>
				    	Subscription Starts : {{ Form::selectMonth('startMonth',$currentMonth, array('onChange' => 'dateRangeSelect()', 'id' => 'month1')) }} {{ Form::selectRange('startYear', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelect()', 'id' => 'year1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
				    	Subscription Ends : {{ Form::selectMonth('endMonth',$endMonth, array('id' => 'month2')) }} {{ Form::selectRange('endYear', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year2')) }}
				    </div>
				    <div class="form-group">
				        <button type="submit" class = "btn btn-primary">Update</submit>
				    </div>
				</form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>
@stop