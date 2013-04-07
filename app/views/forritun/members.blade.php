@extends('forritun.layout')

@section('title')
Fólk í klúbbnum
@stop

@section('main')
<div class="row">
    <div class="span12" id="terminal">
      <table class="table">
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Delete</th>
      </thead>
      @foreach($members as $member)
      <tr>
          <td>
            {{--<a href="admin/edit/{{$member->id}}">{{$member->id}}</a>--}}
            {{$member->id}}
          </td>
          <td>{{$member->name}}</td>
          <td>{{$member->email}}</td>
          <td>
            <a href="admin/delete/{{$member->id}}">Delete</a>
          </td>
      </tr>
      @endforeach
  </table>
</div>
</div>
@stop