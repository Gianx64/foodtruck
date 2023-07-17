@extends('layouts.app')
@section('title', __($event->name))
@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="card">
							<div class="card-header">
								<div style="display: flex; justify-content: space-between; align-items: center;">
									<div class="float-left">
										<h4>Show event: {{$event->name ?? ''}}</h4>
									</div>
									@if (session()->has('message'))
										<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
									@endif
									@can('events.read')
										<div>
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
								@if(strval($foodtrucks_pending) !== '[]')
									<div class="row">
										<h1>Pending foodtrucks ({{count($foodtrucks_pending)}}):</h1>
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
											@foreach ($foodtrucks_pending as $foodtruck)
												<tr>
													<td>{{$foodtruck->foodtruck_name}}</td>
													<td>{{$foodtruck->plate}}</td>
													<td>{{$foodtruck->food}}</td>
													<td>{{$foodtruck->description}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								@endif
								@if(strval($foodtrucks_approved) !== '[]')
									<div class="row">
										<h1>Attending foodtrucks ({{count($foodtrucks_approved)}} / {{$event->slots}}):</h1>
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
											@foreach ($foodtrucks_approved as $foodtruck)
												<tr>
													<td>{{$foodtruck->foodtruck_name}}</td>
													<td>{{$foodtruck->plate}}</td>
													<td>{{$foodtruck->food}}</td>
													<td>{{$foodtruck->description}}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								@endif
								@if($event->date > date("Y-m-d"))
									@auth
										@if(Auth::user()->hasRole('Foodtrucker'))
											@if($event->slots > count($foodtrucks_approved))
												@if($hasfoodtruck)
													@livewire('foodtruck-apply', [$event->id])
												@else
													<p>To apply for this event, you need to register a foodtruck in your profile.</p>
													<h2><a class="nav-link" href="{{ route('users.edit') }}">Click here to go.</a></h2>
												@endif
											@else
												<p>There's no more room for foodtruck applications at this time, keep checking other events!</p>
											@endif
										@endif
									@else
										@if (Route::has('register'))
											<p>Do you have a foodtruck and want to sell food in this event?</p>
											<h1><a class="nav-link" href="{{ route('register') }}">Register now!</a></h1>
										@endif
										@if (Route::has('login'))
											<p><a class="nav-link" href="{{ route('login') }}">If you already have an account, click here to log in.</a></p>
										@endif
									@endif
								@else
									<p>This event is already over, keep checking other events!</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop