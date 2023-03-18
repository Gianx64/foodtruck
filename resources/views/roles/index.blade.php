@extends('layouts.app')

@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	@can('roles.create')
		<a class="btn btn-secondary float-right" href="{{route('roles.create')}}">New Role</a>
	@endcan
	<h1>Roles List</h1>
	<div class="card">
		<div class="card-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Role</th>
						<th colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($roles as $role)
						<tr>
							<td>{{$role->id}}</td>
							<td>{{$role->name}}</td>
							@can('roles.update')
								<td width="10px">
									<a href="{{route('roles.edit', $role)}}" class="btn btn-primary">Edit</a>
								</td>
							@endcan
							@can('roles.delete')
								<td width="10px">
									<form action="{{route('roles.destroy', $role)}}" class="swal-delete" method="post">
										@method('delete')
										@csrf
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</td>
							@endcan
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop

@section('js')
	@include('swal-delete')
	@livewireScripts
@endsection