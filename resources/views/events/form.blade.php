<div class="row">
	<div class="col-md-4">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" value="{{ $event->name ?? old('name') ?? '' }}" placeholder="Name of the event" required autofocus>
		@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="col-md-4">
		<label for="date">Date:</label>
		<input type="date" id="date" name="date" value="{{ $event->date ?? old('date') ?? '' }}" required>
		@error('date')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="col-md-4">
		<label for="address">Address:</label>
		<input type="text" id="address" name="address" value="{{ $event->address ?? old('address') ?? '' }}" placeholder="Address (street name & number)" required>
		@error('address')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
</div>
<div class="row">
	<!--div class="col-md-6">
		<label for="map">Map (image file):</label>
		<input id="map" type="file" name="map" required>
		@error('map')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div-->
	<div class="col-md-6">
		<label for="description">Description:</label>
		<textarea cols=50 type="text" id="description" name="description" value="{{ $event->description ?? old('description') ?? '' }}" placeholder="Event description (extra details, warnings, links, etc.)">
		</textarea>
		@error('description')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
</div>
<input type="hidden" id="owner" name="owner" value="{{auth()->user()->email}}" required>
<button type="submit" class="btn btn-primary">
	{{ __('Submit') }}
</button>