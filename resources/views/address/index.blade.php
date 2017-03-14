@extends ('layouts.address')
@section ('address_content')
    @if (Session::has('status'))
        <div class="Alert">{{ Session::get('status') }}</div>
    @endif
	<h1>All States</h1>
	<ul class="list-group">
	    @foreach ($state as $value)
		    <li class="list-group-item"><a href="/state/{{ $value->id }}">{{$value->name}}({{ $value->addresses->count() }})</a>&nbsp;&nbsp;
		        <sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
		        <a href="/state/{{ $value->id }}/edit">edit</a>&nbsp;&nbsp;
		        <a href="/state/{{ $value->id }}/delete">delete</a>
	        </li>
	    @endforeach
	</ul>

	<hr>
	<h3>Add a new State</h3>
	<form method="POST" action="/state/add-state">
	    {{ csrf_field() }}
	    <div class="form-group">
	        <textarea name="name" class = "form-control" placeholder="Enter the state">{{ old('name') }}</textarea>
	    </div>
	    <div class="form-group">
	        <button type="submit" class = "btn btn-primary">Add State</submit>
	    </div>
	</form>

	@if (count($errors))
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li> {{ $error }} </li>
	        @endforeach
	    </ul>
	@endif

@stop