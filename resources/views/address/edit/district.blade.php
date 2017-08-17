@extends ('layouts.app')
@section ('address_content')
<h2>Edit the note</h2>
	<form method="POST" action="/district/{{ $district->id }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
                <textarea name="name" class = "form-control">{{ $district->name }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class = "btn btn-primary">Update District</submit>
            </div>
    </form>

@stop