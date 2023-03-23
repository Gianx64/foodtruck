@extends('layouts.app')

@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	@can('events.create')
		<a class="btn btn-secondary float-right" href="{{route('events.create')}}">New Event</a>
	@endcan
	<h1>Events List</h1>
	<div class="card">
		<div class="card-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Event name</th>
						<th colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($events as $event)
						<tr>
							<td>{{$event->id}}</td>
							<td>{{$event->name}}</td>
							@can('events.update')
								<td width="10px">
									<a href="{{route('events.edit', $event)}}" class="btn btn-primary">Edit</a>
								</td>
							@endcan
							@can('events.delete')
								<td width="10px">
									<form action="{{route('events.destroy', $event)}}" class="swal-delete" method="post">
										@method('delete')
										@csrf
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</td>
							@endcan
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop

@section('js')
	@include('swal-delete')
	@livewireScripts
@endsection