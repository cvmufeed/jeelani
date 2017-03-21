@extends ('layouts.address')
@section ('address_content')
<ul class="list-group">
	@foreach($subscriptions as $subscription)
		<li class="list-group-item">Subscriptions ending in 
			<a href="/subscriptions/{{$subscription->end_month.$subscription->end_year}}">{{$months[$subscription->end_month]."-".$subscription->end_year}}</a>
			<span class="badge">{{$subscription->count}}</span>
			<a href="/print/subscription/{{$subscription->end_month.$subscription->end_year}}" class="badge"><i class="glyphicon glyphicon-print"></i></a>
		</li>
	@endforeach
</ul>

@stop