@extends('forritun.layout')

@section('title')
Forritunarklúbbur tækniskólans
@stop

@section('main')
<div class="span6 offset3">
	<h2>Tilkynningar</h2>
@foreach($announcements as $announcement)
<div class="row-fluid announcement">
		<h3>{{$announcement->title}}</h3>
		<div class="span10">
			{{$announcement->body}}
		</div>
		<blockquote class="pull-right">
			<p>{{$announcement->member->name}}</p>
			<small>{{date("j.n.Y G:i",strtotime($announcement->created_at))}}</small>
		</blockquote>
</div>
@endforeach
</div>
{{$announcements->links()}}
@stop