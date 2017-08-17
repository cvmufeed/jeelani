@extends('layouts.app')
@section('address_content')
<style type="text/css">
.pointer {
	cursor: pointer; cursor: hand;
}
.table-img {
	margin:auto;
	display:block;
}
</style>
<script>
function change_user_type(value) {
	document.getElementById('form_type').elements['id'].value = value;
	document.getElementById('form_type').elements['type'].value = document.getElementById('type'+value).value;
	document.getElementById('form_type').submit();
}
function delete_user(value,name) {
 	if(confirm('Are you sure you want to delete user:'+name+'?')) {
 		window.location.replace('/edit-user/delete/'+value);
 	}
}
function change_password(value) {
	var password = document.getElementById('password'+value).value;
	if (password) {
		document.getElementById('form_password').elements['password'].value = password;
		document.getElementById('form_password').elements['id'].value = value;
		document.getElementById('form_password').submit();
	}
	else {
		alert('password cannot be empty');
	}
}
function restore_user(value) {
	document.getElementById('form_restore').elements['id'].value = value;
	document.getElementById('form_restore').submit();
}
function permanently_delete_user(value,name) {
	if (confirm('Are you sure you want to delete '+name+' permanently?')) {
		document.getElementById('form_permanent_delete').elements['id'].value = value;
		document.getElementById('form_permanent_delete').submit();
	}
}
</script>
<div class="table-responsive">
<table class="table table-condensed table-hover table-bordered table-striped">
	<tr class="active"><td>No</td><td>Name</td><td>Email</td><td>Type</td><td>Change Password</td><td>Options</td></tr>
	<?php $i=1;$authenticated_user = Auth::user()->id; ?>
	@foreach ($users as $user)
		<tr class="active">
			<td>{{$i++}}</td><td>{{$user->name}}</td><td>{{$user->email}}</td>
			@if ($user->id != $authenticated_user)
			<td>{{ Form::select('type',['admin' => 'admin','superadmin' => 'superadmin'],$user->type,['onchange'=>'change_user_type('.$user->id.')','id'=>'type'.$user->id]) }}</td>
			<td><input type="text" name="password" id="password{{$user->id}}" style="width:85%"><img class="pointer" src="\images\submit.png" width=25 height=25 onclick="change_password({{$user->id}})"></td>
			<td><img class="pointer table-img" src="/images/delete.png" width=25 height=25 title="delete {{$user->name}}" onclick="delete_user({{$user->id}},'{{$user->name}}')">
			</td>
			@else
			<td colspan=3 style="text-align:center">N.A</td>
			@endif
			</tr>
	@endforeach
</table>
</div>
<hr>
<h3>Deleted Users</h3>
<?php $i=1; ?>
@foreach ($deletedusers as $deleteduser)
	{{$i.' '.$deleteduser->name}} <a class="pointer" onclick="restore_user({{$deleteduser->id}})">Restore</a> <img class="pointer" onclick="permanently_delete_user({{$deleteduser->id}},'{{$deleteduser->name}}')" src="/images/delete.png" width=25 height=25 title="Permanently delete {{$deleteduser->name}}">
@endforeach
<form id="form_type" method='post' action="/edit-user/type">
	{{csrf_field()}}
	<input type="hidden" name="id">
	<input type="hidden" name="type">
	<input type="submit" style="display:none">
</form>
<form id="form_password" method="post" action="/edit-user/password">
	{{csrf_field()}}
	<input type="hidden" name="id">
	<input type="hidden" name="password">
	<input type="submit" style="display:none">
</form>
<form id="form_restore" method="post" action="/edit-user/restore">
	{{csrf_field()}}
	<input type="hidden" name="id">
	<input type="submit" style="display:none">
</form>
<form id="form_permanent_delete" method="post" action="/edit-user/permanent-delete">
	{{csrf_field()}}
	<input type="hidden" name="id">
	<input type="submit" style="display:none">
</form>
@stop