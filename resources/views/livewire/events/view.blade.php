@section('title', __('Events'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Event Listing </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Events">
						</div>
						@can('events.create')
							<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
								<i class="fa fa-plus"></i>  Add Events
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
								<td>ID</td> 
								<th>Name</th>
								<th>Owner</th>
								<th>Date</th>
								<th>Address</th>
								<th>Description</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($events as $row)
							<tr>
								<td>{{ $row->id }}</td> 
								<td>{{ $row->name }}</td>
								<td>{{ $row->owner }}</td>
								<td>{{ $row->date }}</td>
								<td>{{ $row->address }}</td>
								<td>{{ $row->description }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="{{route('events.show', $row)}}"><i class="fa fa-file-text"></i> Show </a></li>
											@can('events.update')
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a></li>
											@endcan
											@can('events.delete')
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Event id {{$row->id}}? \nDeleted Events cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a></li>
											@endcan
										</ul>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $events->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>