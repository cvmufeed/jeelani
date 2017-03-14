@extends('layouts.app')
@section('content')
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
				<h4 style="background:#098426;color:white">{{ session('message') }}</h4>
			@endif
        	@yield('address_content')
        </div>
    </div>

@stop