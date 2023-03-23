@extends('layouts.app')

@section('content')
    <div class="row">
		<div class="col-1"></div>
		<div class="col-9">
            <h1>Edit User</h1>
        </div>
        <div class="col">
            <a class="btn btn-primary mr-2 float-right" href="{{ route('home') }}">Go Back</a>
        </div>
    </div>
	<div class="card">
		<div class="card-body">
            <form method="PUT" action="{{ route('users.updateSelf', $user) }}">
                @include('errors')
                @include('user.form')
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </form>
		</div>
	</div>
@stop