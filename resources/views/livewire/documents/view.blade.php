<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Document Listing</h4>
			</div>
			@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
					{{ session('message') }}
				</div>
			@endif
			<div>
				<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Documents">
			</div>
			@can('documents.create' && false)
				<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
					<i class="fa fa-plus"></i>Add Documents
				</div>
			@endcan
		</div>
	</div>
	<div class="card-body">
		@include('livewire.documents.modals')
		<div class="table-responsive" style="height:75vh">
			<table class="table table-bordered table-sm">
				<thead class="thead">
					<tr> 
						<td>ID</td>
						<th>Foodtruck Plate</th>
						<th>Foodtruck Name</th>
						<th>Document Name</th>
						<th>Expiration Date</th>
						<td>ACTIONS</td>
					</tr>
				</thead>
				<tbody>
					@forelse($documents as $row)
					<tr>
						<td>{{ $row->id }}</td>
						<td>{{ $row->plate }}</td>
						<td>{{ $row->foodtruck_name }}</td>
						<td>{{ $row->document_name }}</td>
						<td>{{ $row->expires }}</td>
						<td width="90">
							<div class="dropdown">
								<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
								<ul class="dropdown-menu">
									@can('documents.update')
										<li><a data-bs-toggle="modal" data-bs-target="#reviewDataModal" class="dropdown-item" wire:click="edit({{$row}})"><i class="fa fa-edit"></i>Review</a></li>
									@endcan
									@can('documents.delete')
										<li><a class="dropdown-item" onclick="confirm('Confirm delete document id {{$row->id}}? \nDeleted documents cannot be recovered!')||event.stopImmediatePropagation()"
										wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>Delete</a></li>
									@endcan
								</ul>
							</div>
						</td>
					</tr>
					@empty
						<tr><td class="text-center" colspan="100%">No data found</td></tr>
					@endforelse
				</tbody>
			</table>
			<div class="float-end">{{ $documents->links() }}</div>
		</div>
	</div>
</div>