<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Event Listing</h4>
			</div>
			@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
					{{ session('message') }}
				</div>
			@endif
			<div>
				<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Events">
			</div>
			@can('events.create')
				<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
					<i class="fa fa-plus"></i>Add Event
				</div>
			@endcan
		</div>
	</div>
	<div class="card-body">
		@include('livewire.events.modals')
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead class="thead">
					<tr>
						@can('events.read')
						<td>ID</td> 
						@endcan
						<th>Name</th>
						@can('events.read')
							<th>Owner</th>
						@endcan
						<th>Date</th>
						<th>Address</th>
						<td>ACTIONS</td>
					</tr>
				</thead>
				<tbody>
					@forelse($events as $row)
						<tr>
							@can('events.read')
								<td><a href="{{route('events.show', $row)}}">{{ $row->id }}</a></td>
							@endcan
							<td><a href="{{route('events.show', $row)}}">{{ $row->name }}</a></td>
							@can('events.read')
								<td>{{ $row->owner }}</td>
							@endcan
							<td>{{ $row->date }}</td>
							<td>{{ $row->address }}</td>
							<td width="90">
								@can('events.read')
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="{{route('events.show', $row)}}"><i class="fa fa-file-text"></i>Show</a></li>
											@can('events.update')
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i>Edit</a></li>
											@endcan
											@can('events.delete')
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Event id {{$row->id}}? \nDeleted Events cannot be recovered!')||event.stopImmediatePropagation()"
												wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>Delete</a></li>
											@endcan
										</ul>
									</div>
								@else
									<a class="btn btn-sm btn-secondary" href="{{route('events.show', $row)}}"><i class="fa fa-file-text"></i>Show</a></li>
								@endcan
							</td>
						</tr>
					@empty
						<tr><td class="text-center" colspan="100%">No data found</td></tr>
					@endforelse
				</tbody>
			</table>
			<div class="float-end">{{ $events->links() }}</div>
		</div>
	</div>
</div>