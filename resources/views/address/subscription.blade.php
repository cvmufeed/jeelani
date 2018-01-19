@extends('layouts.app')
@section ('address_content')
<h2>Active Subscription</h2>
<ul class="list-group">
	@foreach($subscriptions as $subscription)
	@if ($subscription->end_year > date('Y') || $subscription->end_year == date('Y') && $subscription->end_month >= date('m'))
	<li class="list-group-item">Subscriptions ending in 
		<a href="/subscriptions/{{$subscription->end_month.$subscription->end_year}}">{{$months[$subscription->end_month]."-".$subscription->end_year}}</a>
		<span class="badge">{{$subscription->count}}</span>
		<div class="dropdown pull-right">
		<button class="btn btn-primary dropdown-toggle js-print js-print-subscription" type="button" data-toggle="dropdown"><i class="glyphicon glyphicon-print"></i>
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="/print/subscription/{{$subscription->end_month.$subscription->end_year}}" class="pull-right">Normal</a></li>
					<li><a href="/print/all/a4?date={{$subscription->end_month.$subscription->end_year}}" class="pull-right">A4</a></li>
				</ul></div>
			</li>
			@endif
			@endforeach
		</ul>
		<h2>Subscription ended</h2>
		@foreach($subscriptions as $subscription)
		@if ($subscription->end_year < date('Y') ||($subscription->end_year == date('Y') && $subscription->end_month < date('m')))
		<li class="list-group-item">Subscriptions ending in 
			<a href="/subscriptions/{{$subscription->end_month.$subscription->end_year}}">{{$months[$subscription->end_month]."-".$subscription->end_year}}</a>
			<span class="badge">{{$subscription->count}}</span>
			<div class="dropdown pull-right">
		<button class="btn btn-primary dropdown-toggle js-print js-print-subscription" type="button" data-toggle="dropdown"><i class="glyphicon glyphicon-print"></i>
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="/print/subscription/{{$subscription->end_month.$subscription->end_year}}" class="pull-right">Normal</a></li>
					<li><a href="/print/all/a4?date={{$subscription->end_month.$subscription->end_year}}" class="pull-right">A4</a></li>
				</ul></div>
		</li>
		@endif
		@endforeach
		@stop