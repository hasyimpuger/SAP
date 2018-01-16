@if(Session::has('error'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ Session::get('error') }}</strong>
	</div>
@endif