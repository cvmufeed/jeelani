@extends('layouts.app')
@section ('address_content')
<br/><br/>
<a href="/home" class="btn btn-primary">Go Back</a>
<!-- editing district -->
<form method="POST" action="" id="edit_form" name="edit_form_1">
            {{ csrf_field() }}
            {{ method_field('patch') }}
</form>
<script>window.state_id = {{$state->id}}</script>
<h2>{{$state->name}}</h2>
<ul class="list-group">
    @foreach ($state->district as $district)
    <li class="list-group-item"><span id="edit{{ $district->id }}"><a href="/district/{{ $district->id }}/addresses" id="edit_content{{ $district->id }}">{{$district->name}}</a>({{ $district->addresses->count() }})&nbsp;&nbsp;
        <sub class="pull-right">Added By: <a href="\profile\{{$district->user['id']}}">{{$district->user['name']}}</a></sub>
        <a onclick="edit({{ $district->id }},'district')">edit</a>&nbsp;&nbsp;
        <a onclick="delete_now({{$district->id}},'{{$district->name}}','district')">delete</a>
        </span>
        <br/>
        <a href="/print/district/{{$district->id}}" class="pull-right"><i class="glyphicon glyphicon-print"></i></a>
        <br/>
        </li>
    @endforeach
</ul>
<hr>
<h3>Add a new District</h3>
<form method="POST" action="/state/{{ $state->id }}/district">
    {{ csrf_field() }}
    <div class="form-group">
        <textarea name="name" class = "form-control" placeholder="Enter the district">{{ old('name') }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class = "btn btn-primary">Add District</submit>
    </div>
</form>

{{ Form::select('state_id',$states,null,['id' => 'select_state_edit','style' => 'display:none']) }}

@if (count($errors))
    <ul>
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
@endif
@stop