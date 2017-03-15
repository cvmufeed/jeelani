@extends('layouts.app')
@section('content')
<script>
    function edit(value,link) {
        var district = document.getElementById('edit_content'+value).innerHTML;
        var edit_string = "<input type='text' value='"+district+"' name='name' form='edit_form'><input type='submit' class = 'btn btn-primary' value='Update' form='edit_form'><a onclick='reload()'>Cancel</a>";
        document.getElementById('edit'+value).innerHTML = edit_string;
        document.edit_form_1.action = "/"+link+"/"+value;
    }
    function delete_now(id,name,link) {
        if(confirm('Are you sure you want to delete '+name+'?')) {
            window.location.replace('/'+link+'/'+id+'/delete');
        }
    }
    function reload() {
        location.reload();
    }
</script>	
	<script>
		function dateRangeSelect() {
			var month1 = document.getElementById('month1').value;
			var year1 = Number(document.getElementById('year1').value);
			if (month1>1) {
				document.getElementById('month2').value = month1-1;
				document.getElementById('year2').value = year1+1;
			}
			else {
				document.getElementById('month2').value = 12;
				document.getElementById('year2').value = year1;
			}
		}
	</script>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        	@if (session('message'))
				<h4 style="background:#00962D;color:white">{{ session('message') }}</h4>
            @elseif (session('success'))
                <h4 style="background:#00962D;color:white">{{ session('success') }}</h4>
			@elseif (session('error'))
                <h4 style="background:#ff0033;color:white">{{ session('error') }}</h4>
            @endif
        	@yield('address_content')
        </div>
    </div>

@stop