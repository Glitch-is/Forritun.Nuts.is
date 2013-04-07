@extends('forritun.layout')

@section('title')
Endurstilla lykilorð
@stop

@section('main')
<div class="span12" id="terminal"></div>
<script>window.token = "{{$token}}";</script>
@stop