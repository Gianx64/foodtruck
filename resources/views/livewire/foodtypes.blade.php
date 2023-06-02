<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Foodtype Listing</h4>
			</div>
			@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
			@endif
			<div>
				<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Foodtype">
			</div>
		</div>
	</div>
	<div class="card-body">
		@can('foodtrucks.create')
			<div>
				<input wire:model='name' type="text" name="name" id="name" placeholder="Food name">
				<button type="button" wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save" class="btn btn-primary">Save</button>
			</div>
		@endcan
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead class="thead">
					<tr> 
						<td>ID</td> 
						<th>Name</th>
						<td>ACTIONS</td>
					</tr>
				</thead>
				<tbody>
					@forelse($foodtypes as $row)
					<tr>
						<td>{{ $row->id }}</td> 
						<td>{{ $row->name }}</td>
						<td width="100">
							@can('foodtrucks.delete')
								<button type="button" onclick="confirm('Confirm Delete Foodtruck id {{$row->id}}? \nDeleted Foodtrucks cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-trash"></i>Delete</button>
							@endcan
						</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="100%">No data found</td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<div class="float-end">{{ $foodtypes->links() }}</div>
		</div>
	</div>
</div>