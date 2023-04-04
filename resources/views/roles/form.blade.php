<div class="form-group">
	<input id="name" type="text" name="name" value="{{$role->name}}" required autofocus>
	@error('name')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>
<h1 class="h3 mt-4 mb-4">Permissions List:</h1>
@foreach ($permissions as $permission)
	<div>
		<input type="checkbox" id="{{$permission->id}}" name="{{$permission->name}}" value="{{$permission->id}}" @checked($role->hasPermissionTo($permission->name))>
		<label for="{{$permission->id}}" class="h5">{{$permission->name}}</label><br>
	</div>
@endforeach