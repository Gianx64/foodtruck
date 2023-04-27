<form>
    <div class="form-group">
        <label for="name"></label>
        <input wire:model="name" type="text" class="form-control" id="name" value="{{$name ?? old('name') ?? '' }}" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="email"></label>
        <input wire:model="email" type="text" class="form-control" id="email" value="{{$email ?? old('email') ?? '' }}" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="password"></label>
        <input wire:model="password" type="password" class="form-control" id="password" placeholder="Password">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation"></label>
        <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Password confirmation">@error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <br><button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
</form>