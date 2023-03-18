@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-8"> 
			<h1>Edit Role</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary mr-2 float-right" href="{{ route('roles.index') }}">Go Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
				<form method="PUT" action="{{ route('roles.update', $role) }}">
					@csrf
					@include('errors')
					@include('roles.form')
					<button type="submit" class="btn btn-primary">
						{{ __('Submit') }}
					</button>
				</form>
			</div>
		</div>
	</div>
@stop