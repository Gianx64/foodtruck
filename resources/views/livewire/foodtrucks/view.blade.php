<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Foodtruck Listing</h4>
			</div>
			@if (session()->has('message'))
			<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
			@endif
			@can('documents.create')
				@if(!empty($foodtrucks->all()))
					@livewire('document-apply')
				@endif
			@endcan
            @can('foodtrucks.create')
                <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
                    <i class="fa fa-plus"></i>Add Foodtruck
                </div>
            @endif
		</div>
	</div>
	<div class="card-body">
        @include('livewire.foodtrucks.modals')
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead class="thead">
					<tr> 
						<td>ID</td>
						<th>Plate</th>
						<th>Foodtruck Name</th>
						<th>Food</th>
						<td>ACTIONS</td>
					</tr>
				</thead>
				<tbody>
					@forelse($foodtrucks as $row)
					<tr>
						<td>{{ $row->id }}</td>
						<td>{{ $row->plate }}</td>
						<td>{{ $row->foodtruck_name }}</td>
						<td>{{ $row->food }}</td>
						<td width="130">
							<a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="btn btn-sm btn-secondary" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i>Edit</a>
							@can('foodtrucks.delete' && false)
								<a class="btn btn-sm btn-danger" onclick="confirm('Confirm delete foodtruck id {{$row->id}}? \nDeleted foodtrucks cannot be recovered!')||event.stopImmediatePropagation()"
								wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>Delete</a>
							@endcan
						</td>
					</tr>
					@empty
					<tr>
						<td class="text-center" colspan="100%">No data found </td>
					</tr>
					@endforelse
				</tbody>
			</table>
			<div class="float-end">{{ $foodtrucks->links() }}</div>
		</div>
	</div>
</div>