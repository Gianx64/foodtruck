@extends('layouts.app')

@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	<h1>Pending Foodtrucks Applications List</h1>
	<div class="card">
		<div class="card-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Event ID</th>
						<th>Food type</th>
						<th>Name</th>
						<th>License plate</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($foodtrucks as $foodtruck)
						<tr>
							<td>{{$foodtruck->id}}</td>
							<td>{{$foodtruck->event_id}}</td>
							<td>{{$foodtruck->food}}</td>
							<td>{{$foodtruck->name}}</td>
							<td>{{$foodtruck->plate}}</td>
							@can('foodtrucks.update')
								<td width="10px">
									<a href="{{route('foodtrucks.show', $foodtruck)}}" class="btn btn-primary">Review</a>
								</td>
							@endcan
							@can('foodtrucks.delete')
								<td width="10px">
									<form action="{{route('foodtrucks.destroy', $foodtruck)}}" class="swal-delete" method="post">
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
	@include('swal-delete')
	@livewireScripts
@stop