@extends ('layouts.address')
@section ('address_content')
<br/><br/>
<a href="/home" class="btn btn-primary">Go Back</a>
<!-- editing district -->
<form method="POST" action="" id="edit_form" name="edit_form_1">
            {{ csrf_field() }}
            {{ method_field('patch') }}
</form>

<h2>{{$state->name}}</h2>
<ul class="list-group">
    @foreach ($state->district as $district)
    <li class="list-group-item"><span id="edit{{ $district->id }}"><a href="/district/{{ $district->id }}/addresses" id="edit_content{{ $district->id }}">{{$district->name}}</a>({{ $district->addresses->count() }})&nbsp;&nbsp;
        <sub class="pull-right">Added By: <a href="\profile\{{$district->user['id']}}">{{$district->user['name']}}</a></sub>
        <a onclick="edit({{ $district->id }},'district')">edit</a>&nbsp;&nbsp;
        <a onclick="delete_now({{$district->id}},'{{$district->name}}','district')">delete</a>
        </span>
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


@if (count($errors))
    <ul>
        @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
@endif

<!-- 
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Edit</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label><b>Edit the District</b></label>
      <input type="text" name="name" value="Kannur" required>

        
      <button type="submit">Update District</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div> -->
@stop