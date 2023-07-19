<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Applications Listing</h4>
			</div>
			@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
					{{ session('message') }}
				</div>
			@endif
			<div>
				<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Foodtrucks">
			</div>
			@can('foodtrucks.create' && false)
				<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
					<i class="fa fa-plus"></i>Add Foodtrucks
				</div>
			@endcan
		</div>
	</div>
	<div class="card-body">
		@include('livewire.applications.modals')
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead class="thead">
					<tr> 
						<td>ID</td> 
						<th>Event</th>
						<th>Plate</th>
						<th>Foodtruck Name</th>
						<th>Owner</th>
						<th>Food</th>
						<td>ACTIONS</td>
					</tr>
				</thead>
				<tbody>
					@forelse($foodtrucks as $row)
					<tr>
						<td>{{ $row->id }}</td> 
						<td><a class="nav-link" href="{{route('events.show', $row->event_id)}}">{{$row->name}}</a></td>
						<td>{{ $row->plate }}</td>
						<td>{{ $row->foodtruck_name }}</td>
						<td>{{ $row->email }}</td>
						<td>{{ $row->food }}</td>
						<td width="90">
							<div class="dropdown">
								<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
								<ul class="dropdown-menu">
									@can('foodtrucks.update')
										<li><a data-bs-toggle="modal" data-bs-target="#reviewDataModal" class="dropdown-item" wire:click="edit({{$row}})"><i class="fa fa-edit"></i>Review</a></li>
									@endcan
									<li><a class="dropdown-item" href="{{route('events.show', $row->event_id)}}"><i class="fa fa-file-text"></i>Show event</a></li>
									@can('foodtrucks.delete')
										<li><a class="dropdown-item" onclick="confirm('Confirm delete application id {{$row->id}}? \nDeleted Foodtrucks cannot be recovered!')||event.stopImmediatePropagation()"
										wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>Delete</a></li>
									@endcan
								</ul>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="100%">No data found</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<div class="float-end">{{ $foodtrucks->links() }}</div>
		</div>
	</div>
</div>