@extends('forritun.layout')

@section('title')
Breyta tilkynningu
@stop

@section('main')
@if(isset($error))
<div class="alert alert-error">
	{{$error}}
</div>
@endif
<form method="post" accept-charset="utf8" action="/profile" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="name">Nafn</label>
		<div class="controls">
			<input type="text" name="name" id="name" placeholder="Nafn" value="{{Auth::user()->name}}">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Tölvupóstur</label>
		<div class="controls">
			<input type="text" name="email" id="email" placeholder="Nafn" value="{{Auth::user()->email}}">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Símanúmer</label>
		<div class="controls">
			<input type="text" name="phone" id="phone" placeholder="Símanúmer" value="{{Auth::user()->phone}}">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Lykilorð</label>
		<div class="controls">
			<input type="password" name="password" placeholder="Lykilorð">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Lykilorð(aftur)</label>
		<div class="controls">
			<input type="password" name="password_confirmation" placeholder="Lykilorð">
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success">Vista</button>
		</div>
	</div>
</form>
@stop