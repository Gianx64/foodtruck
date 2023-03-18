<div>
	<div class="card">			
		<div class="card-header">
			<input wire:model="search" class="form-control" placeholder="Enter a user name or email">
		</div>
		@if ($users->count())		
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Created</th>
							<th>Updated</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->created_at}}</td>
								<td>{{$user->updated_at}}</td>

								@can('users.update')
									<td>
										<a class="btn btn-primary float-right" href="{{route('users.assign', $user)}}">Give Role</a>
									</td>
									<td>
										<a class="btn btn-success float-left" href="{{route('users.edit', $user)}}">Edit</a>
									</td>
								@endcan

								@can('users.delete')
									<td>
										<form action="{{route('users.destroy', $user)}}" class="swal-delete" method="POST">
											@method('DELETE')
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
			<div class="card-footer">
				{{$users->links()}}
			</div>
		@else
			<div class="card-body">
				<strong>There's no user with that name or email ...</strong>
			</div>
		@endif
	</div>
</div>