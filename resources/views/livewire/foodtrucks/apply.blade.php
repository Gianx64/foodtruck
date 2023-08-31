<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="float-left">
				<h4><i class="fab fa-laravel text-info"></i>Foodtruck Listing</h4>
			</div>
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
                        <td width="90">
                            @can('foodtrucks.create')
                                <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#showDataModal" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i>Apply</a>
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
        </div>
    </div>
</div>