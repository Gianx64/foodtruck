@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-1"></div>
		<div class="col-9">
			<h1>Events List</h1>
		</div>
		<div class="col">
			@can('events.create')
				<a class="btn btn-secondary float-right" href="{{route('events.create')}}">New Event</a>
			@endcan
		</div>
	</div>
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	@livewire("event-index")
	@include('swal-delete')
	@livewireScripts
@stop