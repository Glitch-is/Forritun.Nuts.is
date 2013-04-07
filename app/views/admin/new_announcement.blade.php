@extends('forritun.layout')

@section('title')
Ný tilkynning
@stop

@section('main')
<form method="post" accept-charset="utf8" action="/admin/announcement/new" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="title">Titill</label>
    <div class="controls">
      <input type="text" name="title" id="title" placeholder="Titill" value="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="text">Texti</label>
    <div class="controls">
      <textarea class="span6" id="text" name="text" rows="10" placeholder="Texti"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">Vista</button>
    </div>
  </div>
</form>
@stop