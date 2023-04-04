@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-8"> 
			<h1>Show Role</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary mr-2 float-right" href="{{ route('roles.index') }}">Go Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
                <h2>{{$role->name}}</h2>
            </div>
            <h3 class="h3 mt-4 mb-4">Permissions List:</h3>
            @foreach ($role->permissions as $permission)
                <h5>{{$permission->name}}</h5><br>
            @endforeach
		</div>
	</div>
@stop