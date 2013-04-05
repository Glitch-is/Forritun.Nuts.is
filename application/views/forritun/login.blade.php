@layout('forritun.layout')
@section('title')
Skrá inn í vef forritunarklúbbsins
@endsection

@section('main')
<div class="row">
	<div class="span3">
		<form method="POST" action="/login" class="form-horizontal">
			<input type="text" name="username" placeholder="Póstfang">
			<input type="password" name="password" placeholder="Lykilorð">
			<input type="submit" class="btn btn-success">
		</form>
	</div>
</div>
@endsection