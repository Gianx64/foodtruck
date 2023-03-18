@extends('layouts.app')

@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	@can('users.create')
		<a class="btn btn-secondary float-right" href="{{route('users.create')}}">Create User</a>
	@endcan
	<h1>Users List</h1>
	@livewire("user-index")
@stop

@section('js')
	@include('swal-delete')
	@livewireScripts
@endsection