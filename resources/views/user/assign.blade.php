@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-8"> 
			<h1>Assign Role</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary mr-2 float-right" href="{{ route('users.index') }}">Go Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
				<p class="h5">Name:</p>
				<p class="form-control">{{$user->name}}</p>
				<form method="PUT" action="{{ route('users.assign', $user) }}">
					<h4>Roles List:</h4>
					@foreach ($roles as $role)
						<div>
							<input type="checkbox" id={{$role->id}} name="roles[]" value={{null}}>
							<label>{{$role->name}}</label><br>
						</div>
					@endforeach
					<button type="submit" class="btn btn-primary">
						{{ __('Submit') }}
					</button>
				</form>
			</div>
		</div>
	</div>
@stop