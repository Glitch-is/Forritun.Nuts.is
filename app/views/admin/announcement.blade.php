@extends('forritun.layout')

@section('title')
Breyta tilkynningu
@stop

@section('main')
<form method="post" accept-charset="utf8" action="/admin/announcement/edit/{{$id}}" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="title">Titill</label>
		<div class="controls">
			<input type="text" name="title" id="title" placeholder="Titill" value="{{$announcement->title}}">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="text">Texti</label>
		<div class="controls">
			<textarea id="text" class="span6" rows="10" name="text" placeholder="Texti">{{$announcement->body}}</textarea>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success">Vista</button>
		</div>
	</div>
</form>
@stop