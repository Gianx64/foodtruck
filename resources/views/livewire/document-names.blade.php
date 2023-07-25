<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Document Names Listing</h4>
			</div>
			@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
			@endif
			<div>
				<input wire:model='name' type="text" name="name" id="name" placeholder="Document name">
				<button type="button" wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save" class="btn btn-primary">Save</button>
			</div>
			<div>
				<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search document name">
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive" style="height:30vh">
			<table class="table table-bordered table-sm">
				<thead class="thead">
					<tr> 
						<td>ID</td>
						<th>Name</th>
						<th>Created At</th>
						<td>ACTIONS</td>
					</tr>
				</thead>
				<tbody>
					@forelse($documentnames as $row)
					<tr>
						<td>{{ $row->id }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->created_at }}</td>
						<td width="100">
							<button type="button" onclick="confirm('Confirm delete document name {{$row->name}}? \nDeleted document names cannot be recovered!')||event.stopImmediatePropagation()"
                            wire:click="destroy({{$row->id}})" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-trash"></i>Delete</button>
						</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="100%">No data found</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<div class="float-end">{{ $documentnames->links() }}</div>
		</div>
	</div>
</div>