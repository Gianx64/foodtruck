@if (count($errors) > 0)
	<div class="alert alert-danger mt-4">
		<p>Corrige los siguientes errores:</p>
		<ul>
			@foreach ($errors->all() as $error)
				<strong><li>{{$error}}</li></strong>
			@endforeach
		</ul>
	</div>
@endif