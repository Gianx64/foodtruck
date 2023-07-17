<div>
    @include('livewire.foodtrucks.modals')
    @if($hasFoodtruck)
        <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#updateDataModal">
            <i class="fa fa-edit"></i>Edit Foodtruck
        </div>
    @else
        <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
            <i class="fa fa-plus"></i>Add Foodtruck
        </div>
    @endif
</div>