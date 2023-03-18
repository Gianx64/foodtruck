<div class="form-group">
	<input id="name" type="text" name="name" value="{{$user->name ?? ''}}" placeholder="User name" required autofocus>
	@error('name')
	  <span class="invalid-feedback" role="alert">
		  <strong>{{ $message }}</strong>
	  </span>
	@enderror
</div>
<div class="form-group">
	<input id="email" type="email" name="email" value="{{$user->email ?? ''}}" placeholder="User email" required autofocus>
	@error('email')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>
<div class="form-group">
	<input id="password" type="password" name="password" placeholder="Password" required autofocus>
	@error('password')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>
<div class="form-group">
	<input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required autofocus>
	@error('password_confirmation')
		<span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		</span>
	@enderror
</div>