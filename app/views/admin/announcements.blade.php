@extends('forritun.layout')

@section('title')
Tilkynningar
@stop

@section('main')
<div class="row-fluid">
    <div class="span12">
      <table class="table">
        <thead>
          <th>ID</th>
          <th>Name</th>
          <th>By</th>
          <th>Delete</th>
      </thead>
      @foreach($announcements as $announcement)
      <tr>
          <td>
          	<a href="/admin/announcement/edit/{{$announcement->id}}">
          		{{$announcement->id}}
          	</a>
          </td>
          <td>{{$announcement->title}}</td>
          <td>{{$announcement->member->name}}</td>
          <td>
            <a href="/admin/announcement/delete/{{$announcement->id}}">
              Delete
            </a>
          </td>
      </tr>
      @endforeach
      <tr>
        <td>
          <a href="/admin/announcement/new">Ný tilkynning</a>
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
  </table>
</div>
</div>
@stop