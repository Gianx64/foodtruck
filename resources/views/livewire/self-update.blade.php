@extends('layouts.app')

@section('content')
    <div class="row">
		<div class="col-1"></div>
		<div class="col-9">
            <h1>Edit Profile</h1>
        </div>
        <div class="col">
            <a class="btn btn-primary mr-2 float-right" href="{{ route('home') }}">Go Back</a>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name"></label>
                    <input wire:model="name" type="text" class="form-control" id="name" value="{{$user->name ?? old('name') ?? '' }}" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="email"></label>
                    <input wire:model="email" type="text" class="form-control" id="email" value="{{$user->email ?? old('email') ?? '' }}" placeholder="Email">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <input wire:model="password" type="password" class="form-control" id="password" placeholder="Password">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation"></label>
                    <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Password confirmation">@error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </form>
            <br><button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
		</div>
	</div>
@stop