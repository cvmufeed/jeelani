@extends ('layouts.address')
@section ('address_content')
<h2>Active Subscription</h2>
<ul class="list-group">
	@foreach($subscriptions as $subscription)
		@if ($subscription->end_year > date('Y') || $subscription->end_year == date('Y') && $subscription->end_month >= date('m'))
			<li class="list-group-item">Subscriptions ending in 
				<a href="/subscriptions/{{$subscription->end_month.$subscription->end_year}}">{{$months[$subscription->end_month]."-".$subscription->end_year}}</a>
				<span class="badge">{{$subscription->count}}</span>
				<a href="/print/subscription/{{$subscription->end_month.$subscription->end_year}}" class="badge"><i class="glyphicon glyphicon-print"></i></a>
			</li>
		@endif
	@endforeach
</ul>
<h2>Subscription ended</h2>
	@foreach($subscriptions as $subscription)
		@if ($subscription->end_year <= date('Y') && $subscription->end_month < date('m'))
			<li class="list-group-item">Subscriptions ending in 
				<a href="/subscriptions/{{$subscription->end_month.$subscription->end_year}}">{{$months[$subscription->end_month]."-".$subscription->end_year}}</a>
				<span class="badge">{{$subscription->count}}</span>
				<a href="/print/subscription/{{$subscription->end_month.$subscription->end_year}}" class="badge"><i class="glyphicon glyphicon-print"></i></a>
			</li>
		@endif
	@endforeach
@stop