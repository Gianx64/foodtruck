@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-8"> 
			<h1>Create New Role</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary mr-2 float-right" href="{{ route('roles.index') }}">Go Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
				<form method="POST" action="{{ route('roles.store') }}">
					@csrf
					@include('errors')
					<div class="col-md-6">
						<input id="name" type="string" name="name" value="{{ old('name') }}" required autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<button type="submit" class="btn btn-primary">
						{{ __('Submit') }}
					</button>
				</form>
			</div>
		</div>
	</div>
@stop