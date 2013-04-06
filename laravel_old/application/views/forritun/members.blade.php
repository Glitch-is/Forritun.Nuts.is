@layout('forritun.layout')

@section('title')
Fólk í klúbbnum
@endsection

@section('main')
<div class="row">
    <div class="span12" id="terminal">
      <table class="table">
        <thead>
          <th>ID</th>
          <th>Name</th>
      </thead>
      @foreach($members as $member)
      <tr>
          <td>{{$member->id}}</td>
          <td>{{$member->name}}</td>
      </tr>
      @endforeach
  </table>
</div>
</div>
@endsection