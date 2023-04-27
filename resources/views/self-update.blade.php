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
            @livewire('self-update')
		</div>
	</div>
@stop