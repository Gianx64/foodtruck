@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-1"></div>
		<div class="col"> 
			<h1>Apply Foodtruck</h1>
		</div>
			<div class="col-1">
				<a class="btn btn-primary mr-2 float-right" href="{{ route('events.show', $foodtruck->event_id) }}">Go Back</a>
			</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group container-fluid">
				<form method="POST" action="{{ route('foodtrucks.store') }}">
					@csrf
					@include('errors')
					<p>Applying for event {{ $foodtruck->event_id }}</p>
					@include('foodtrucks.form')
				</form>
			</div>
		</div>
	</div>
@stop