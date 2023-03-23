@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-1"></div>
		<div class="col-9">
			<h1>Show {{$event->name}}</h1>
		</div>
		@can('events.read')
			<div class="col">
				<a class="btn btn-primary mr-2 float-right" href="{{ route('events.index') }}">Go Back</a>
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
	</div>
@stop