@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-1"></div>
		<div class="col-9">
			<h1>Users List</h1>
		</div>
		<div class="col">
			@can('users.create')
				<a class="btn btn-secondary float-right" href="{{route('users.create')}}">Create User</a>
			@endcan
		</div>
	</div>
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	@livewire("user-index")
@stop

@section('js')
	@include('swal-delete')
	@livewireScripts
@endsection