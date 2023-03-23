<div>
	<div class="card">			
		<div class="card-header">
				<input wire:model="search" class="form-control" placeholder="Write the event name or owner">
		</div>
		@if ($events->count())		
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Owner</th>
							<th>Created at</th>
							<th>Updated at</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($events as $event)
							<tr>
								<td>{{$event->id}}</td>
								<td>{{$event->name}}</td>
								<td>{{$event->owner}}</td>
								<td>{{$event->created_at}}</td>
								<td>{{$event->updated_at}}</td>

								@can('events.read')
									<td>
										<a class="btn btn-primary float-left" href="{{route('events.show', $event)}}">Show</a>
									</td>
								@endcan

								@can('events.update')
									<td>
										<a class="btn btn-success float-left" href="{{route('events.edit', $event)}}">Edit</a>
									</td>
								@endcan

								@can('events.delete')
									<td>
										<form action="{{route('events.destroy', $event)}}" class="swal-delete" method="POST">
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
				{{$events->links()}}
			</div>
		@else
			<div class="card-body">
				<strong>There's no events with that name or owner ...</strong>
			</div>
		@endif
	</div>
</div>