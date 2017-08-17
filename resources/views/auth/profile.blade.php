@extends('layouts.app')
@section('address_content')
<br/><br/>
Name: {{$user->name}}
<br/>Email: {{$user->email}}
<br/>Type: {{$user->type}}
<br/>Created On: {{$user->created_at}}
@stop