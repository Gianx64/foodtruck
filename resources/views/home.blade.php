@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
	<div class="container-fluid" id="top">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><h5><span class="text-center fa fa-home"></span>@yield('title')</h5></div>
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<div class="card-body">
						<div class="row w-100">
							<div class="col-md-4">
								<div class="card border-success mx-sm-1 p-3">
									<div class="card border-success text-success p-3 my-card"><span class="text-center fa fa-calendar" aria-hidden="true"></span></div>
									<div class="text-success text-center mt-3"><a href="{{ url('/events') }}" class="nav-link"><h4>Future Events</h4></a></div>
									<div class="text-success text-center mt-2"><h1>{{ $data[0] }}</h1></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card border-danger mx-sm-1 p-3">
									<div class="card border-danger text-danger p-3" ><span class="text-center fa fa-truck" aria-hidden="true"></span></div>
									<div class="text-danger text-center mt-3"><a href="{{ url('/applications') }}" class="nav-link"><h4>Pending Foodtruck Applications</h4></a></div>
									<div class="text-danger text-center mt-2"><h1>{{ $data[1] }}</h1></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card border-info mx-sm-1 p-3">
									<div class="card border-info text-info p-3 my-card" ><span class="text-center fa fa-file" aria-hidden="true"></span></div>
									<div class="text-info text-center mt-3"><a href="{{ url('/documents') }}" class="nav-link"><h4>Pending Document Applications</h4></a></div>
									<div class="text-info text-center mt-2"><h1>{{ $data[2] }}</h1></div>
								</div>
							</div>
						</div>
						<hr>
						@livewire('events')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection