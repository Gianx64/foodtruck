<input type="hidden" id="event_id" name="event_id" value="{{ $foodtruck->event_id }}">
<div class="row">
	<div class="form-group">
		<label for="name">Foodtruck name:</label>
		<input type="text" id="name" name="name" value="{{ $foodtruck->name ?? old('name') }}" placeholder="Name of the foodtruck" required autofocus>
		@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group">
		<label for="plate">License plate:</label>
		<input type="text" id="plate" name="plate" value="{{ $foodtruck->plate ?? old('plate') }}" placeholder="Foodtruck vehicle license plate" required>
		@error('plate')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group">
		<label for="owner">Owner email:</label>
		<input id="owner" type="email" name="owner" value="{{ $foodtruck->owner ?? old('owner') }}" placeholder="Owner email" required>
		@error('owner')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group">
		<label for="food">Food type:</label>
		<select name="food" id="food" value="{{ $foodtruck->food ?? old('food') ?? 'Burgers' }}">
			<option value="Burgers">Burgers</option>
			<option value="Corn">Corn</option>
			<option value="Hot Dogs">Hot Dogs</option>
			<option value="Tacos">Tacos</option>
			<option value="Vegan">Vegan</option>
		</select>
	</div>
</div>
<div class="row">
	<!--div class="col-md-6">
		<label for="vehicle">Foodtruck picture:</label>
		<input id="vehicle" type="file" name="vehicle">
		@error('vehicle')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div-->
	<div class="col-md-6">
		<label for="description">Description:</label>
		<textarea cols=50 type="text" id="description" name="description" value="{{ $foodtruck->description ?? old('description') }}" placeholder="Foodtruck description (extra details, warnings, links, etc.)">
		</textarea>
		@error('description')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
</div>
<button type="submit" class="btn btn-primary">
	{{ __('Submit') }}
</button>