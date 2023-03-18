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
                <h3>{{$role->name}}</h3>
            </div>
            <h1 class="h3 mt-4 mb-4">Permissions List:</h1>
            @foreach ($permissions as $permission)
                <div>
                    <input type="checkbox" id={{$permission->id}} name="permissions[]" value="{{null}}">
                    <label>{{$permission->name}}</label><br>
                </div>
            @endforeach
		</div>
	</div>
@stop