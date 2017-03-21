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
	form.elements['start_month'].value = document.getElementById('start_month_'+value).value;
	form.elements['start_year'].value = document.getElementById('start_year_'+value).value;
	form.elements['end_month'].value = document.getElementById('end_month_'+value).value;
	form.elements['end_year'].value = document.getElementById('end_year_'+value).value;
}
</script>


<ul class="list-group">
<li class="list-group-item">Total <span class="badge">{{$address->count()}}</span></li>
	    @foreach ($address as $value)
	    	<div class="list-group-item">
	    		<sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
	    		<a id="name_{{$value->id}}">{{ $value->name}}</a>
	    		#{{$value->id}}<br/>
	    		{!! nl2br($value->address) !!}<br/><input type="hidden" value="{{$value->address}}" id="address_{{$value->id}}">
		        <div id="city_{{$value->id}}">{{$value->city}}</div>
		        <div id="district_{{$value->id}}">{{$value->district->name}}</div>
		        <div id="state_{{$value->id}}">{{$value->state->name}}</div>
		        Phone: <span id="phone_{{$value->id}}">{{$value->phone}}</span><br/>
		        Pin: <span id="pin_{{$value->id}}">{{$value->pin}}</span><br/>
		        From: {{$month[$value->start_month]}}-{{$value->start_year}}<input type="hidden" id="start_month_{{$value->id}}" value="{{$value->start_month}}"><input type="hidden" id="start_year_{{$value->id}}" value="{{$value->start_year}}">
		        To: {{$month[$value->end_month]}}-{{$value->end_year}}<input type="hidden" id="end_month_{{$value->id}}" value="{{$value->end_month}}"><input type="hidden" id="end_year_{{$value->id}}" value="{{$value->end_year}}">
		        <a href="#editModal" data-toggle="modal" onclick="editNow({{$value->id}})">edit</a>&nbsp;&nbsp;
		        <a href="#deleteModal" data-toggle="modal" onclick="deleteNow({{$value->id}})">delete</a>
		        <a href="/print/address/{{$value->id}}" class="pull-right"><i class="glyphicon glyphicon-print"></i></a>
	        </div>
	    @endforeach
	    @if ($address->count() == 0)
	    <li class="list-group-item">Sorry... :( No Address...</li>
	    @endif
</ul>


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
	          <h4 class="modal-title" id="modal_title">Edit Address</h4>
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
				    	Subscription Starts : {{ Form::selectMonth('start_month',$currentMonth, array('onChange' => 'dateRangeSelect()', 'id' => 'month1')) }} {{ Form::selectRange('start_year', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelect()', 'id' => 'year1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
				    	Subscription Ends : {{ Form::selectMonth('end_month',$endMonth, array('id' => 'month2')) }} {{ Form::selectRange('end_year', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year2')) }}
				    </div>
				    <div class="form-group">
				        <button type="submit" class = "btn btn-primary" id="modal_submit">Update</submit>
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