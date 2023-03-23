@if (count($errors) > 0)
	<div class="alert alert-danger mt-4">
		<p>Correct these errors:</p>
		<ul>
			@foreach ($errors->all() as $error)
				<strong><li>{{$error}}</li></strong>
			@endforeach
		</ul>
	</div>
@endif