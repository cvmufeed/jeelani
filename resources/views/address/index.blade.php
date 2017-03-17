@extends ('layouts.address')
@section ('address_content')
    @if (Session::has('status'))
        <div class="Alert">{{ Session::get('status') }}</div>
    @endif
	<h1>All States</h1>
	<ul class="list-group">
	    @foreach ($state as $value)
		    <li class="list-group-item" id="edit{{$value->id}}"><a href="/state/{{ $value->id }}"><span id="edit_content{{$value->id}}">{{$value->name}}</span>({{ $value->addresses->count() }})</a>&nbsp;&nbsp;
		        <sub class="pull-right">Added By: <a href="\profile\{{$value->user['id']}}">{{$value->user['name']}}</a></sub>
		        <a onclick="edit({{$value->id}},'state')">edit</a>&nbsp;&nbsp;
		        <a onclick="delete_now({{$value->id}},'{{$value->name}}', 'state')">delete</a>
		        <br/>
		        <a href="/print/state/{{$value->id}}" class="pull-right"><i class="glyphicon glyphicon-print"></i></a>
		        <br/>
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
<form method="POST" action="" id="edit_form" name="edit_form_1">
            {{ csrf_field() }}
            {{ method_field('patch') }}
</form>
	@if (count($errors))
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li> {{ $error }} </li>
	        @endforeach
	    </ul>
	@endif

@stop