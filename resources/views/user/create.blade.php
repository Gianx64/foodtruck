@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-1"></div>
		<div class="col-9">
			<h1>Register User (Administrator)</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary mr-2 float-right" href="{{ route('users.index') }}">Go Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
				<form method="POST" action="{{ route('users.store') }}">
					@csrf
					@include('errors')
					@include('user.form')
					<h4>Roles List:</h4>
					@foreach ($roles as $role)
						<div>
							<input type="checkbox" id="{{$role->id}}" name="roles[]" value="{{null}}">
							<label for="{{$role->id}}" class="h5">{{$role->name}}</label><br>
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