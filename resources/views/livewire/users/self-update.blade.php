<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4>Update Profile</h4>
			</div>
            @if (session()->has('message'))
                <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
            @endif
            @can('foodtrucks.create')
				@livewire('foodtruck')
            @endcan
		</div>
	</div>
	<div class="card-body">
        <form>
            <div class="form-group">
                <label for="name">User name:</label>
                <input wire:model="name" type="text" class="form-control" id="name" value="{{$name ?? old('name') ?? '' }}" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input wire:model="email" type="text" class="form-control" id="email" value="{{$email ?? old('email') ?? '' }}" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input wire:model="password" type="password" class="form-control" id="password" placeholder="Password">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm password:</label>
                <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Password confirmation">@error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <br><button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
        </form>
	</div>
</div>