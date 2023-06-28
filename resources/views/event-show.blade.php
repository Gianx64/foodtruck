@extends('layouts.app')
@section('title', __($event->name))
@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="card">
							<div class="card-header">
								<div style="display: flex; justify-content: space-between; align-items: center;">
									<div class="col-10">
										<h4>Show event: {{$event->name ?? 'event'}}</h4>
									</div>
									@can('events.read')
										<div class="col">
											<a class="btn btn-primary mr-2 float-right" href="{{ route('events.index') }}">Events index</a>
										</div>
									@endcan
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<h3>Date:</h3>
										<h1>{{$event->date}}</h1>
									</div>
									<div class="col-6">
										<h3>Address:</h3>
										<a href="https://www.google.com/maps/search/{{$event->address}}" target="_blank" rel="noopener noreferrer"><h1>{{$event->address}}</h1></a>
									</div>
								</div>
								@if ($event->description)
									<div class="col-10">
										<details close>
											<summary>Description:</summary>
											<h3>{{$event->description}}</h3>
										</details>
									</div>
								@endif
								<div class="col-10">
									<details close>
										<summary>Event map:</summary>
										<img src="{{ asset($event->map) }}" width=1024>
									</details>
								</div>
							</div>
							<div class="card-body">
								@if(strval($foodtrucks) !== '[]')
									<div class="row">
										<h1>Attending foodtrucks ({{count($foodtrucks)}} / {{$event->slots}}):</h1>
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
									@if($event->date > date("Y-m-d"))
										@if($event->slots > count($foodtrucks))
											<a class="nav-link" href="{{ route('foodtrucks.create', $event->id) }}">Is your foodtruck missing in this list?<h1>Apply now!</h1></a>
										@else
											<p>There's no more room for foodtruck applications at this time, keep checking other events!</p>
										@endif
									@else
										<p>This event is already over, keep checking other events!</p>
									@endif
								@else
									<a class="nav-link" href="{{ route('foodtrucks.create', $event->id) }}">Do you have a foodtruck and want to sell food in this event?<h1>Apply now!</h1></a>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop