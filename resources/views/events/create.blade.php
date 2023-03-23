@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-1"></div>
		<div class="col-9"> 
			<h1>Create New Event</h1>
		</div>
		<div class="col">
			<a class="btn btn-primary mr-2 float-right" href="{{ route('events.index') }}">Go Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
				<form method="POST" action="{{ route('events.store') }}">
					@csrf
					@include('errors')
					@include('events.form')
				</form>
			</div>
		</div>
	</div>
@stop