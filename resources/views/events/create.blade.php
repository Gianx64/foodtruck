@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-8"> 
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
					<div class="col-md-6">
						<label for="name">Name:</label>
						<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Name of the event" required autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="date">Date:</label>
						<input id="date" type="date" name="date" value="{{ old('date') }}" required>
						@error('date')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-md-6">
						<label for="address">Address:</label>
						<input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="Address (street name & number)" required>
						@error('address')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<!--div class="col-md-6">
						<label for="map">Map (image file):</label>
						<input id="map" type="file" name="map" value="{{ old('map') }}" required>
						@error('map')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div-->
					<input type="hidden" id="owner" name="owner" value="{{auth()->user()->email}}">
					<button type="submit" class="btn btn-primary">
						{{ __('Submit') }}
					</button>
					<div class="col-md-6">
						<label for="description">Description:</label>
						<textarea cols=10 id="description" type="text" name="description" value="{{ old('description') }}" placeholder="Event description (extra details, warnings, links, etc.)" required>
						@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</form>
			</div>
		</div>
	</div>
@stop