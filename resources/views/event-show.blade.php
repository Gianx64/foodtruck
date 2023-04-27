@extends('layouts.app')

@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	<div class="row">
		<div class="col-1"></div>
		<div class="col-9">
			<h1>Show {{$event->name ?? 'event'}}</h1>
		</div>
		@can('events.read')
			<div class="col">
				<a class="btn btn-primary mr-2 float-right" href="{{ route('events.index') }}">Events index</a>
			</div>
		@endcan
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-3">
					<h1>Date:</h1>
					<h3>{{$event->date}}</h3>
				</div>
				<div class="col-3">
					<h1>Address:</h1>
					<h3>{{$event->address}}</h3>
				</div>
			</div>
			<div class="col-3">
				<h1>Description:</h1>
				<h3>{{$event->description}}</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<h1>Attending foodtrucks:</h1>
			</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Plate</th>
						<th>Food type</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($foodtrucks as $foodtruck)
						<tr>
							<td>{{$foodtruck->name}}</td>
							<td>{{$foodtruck->plate}}</td>
							<td>{{$foodtruck->food}}</td>
							<td>{{$foodtruck->description}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<a class="nav-link" href="{{ route('foodtrucks.create', $event->id) }}">Is your foodtruck missing in this list? <h4>Apply now!</h4></a>
		</div>
	</div>
@stop