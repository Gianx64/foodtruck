<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Foodtruck</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="event_id"></label>
                        <input wire:model="event_id" type="text" class="form-control" id="event_id" placeholder="Event Id">@error('event_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="name"></label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="plate"></label>
                        <input wire:model="plate" type="text" class="form-control" id="plate" placeholder="Plate">@error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="owner"></label>
                        <input wire:model="owner" type="text" class="form-control" id="owner" placeholder="Owner">@error('owner') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food"></label>
                        <input wire:model="food" type="text" class="form-control" id="food" placeholder="Food">@error('food') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description"></label>
                        <input wire:model="description" type="text" class="form-control" id="description" placeholder="Description">@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Review Foodtruck</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="event_id">Event ID <!--a href="{ route('events.show', $event_id) }}">(Click to go)</a--></label>
                        <input wire:model="event_id" type="text" class="form-control" id="event_id" placeholder="Event Id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Foodtruck Name:</label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="plate">Owner Email:</label>
                        <input wire:model="plate" type="text" class="form-control" id="plate" placeholder="Plate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="owner">License Plate:</label>
                        <input wire:model="owner" type="text" class="form-control" id="owner" placeholder="Owner" readonly>
                    </div>
                    <div class="form-group">
                        <label for="food">Food type:</label>
                        <input wire:model="food" type="text" class="form-control" id="food" placeholder="Food" readonly>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input wire:model="description" type="text" class="form-control" id="description" placeholder="Description" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @can('foodtrucks.delete')
                    <div class="col-9">
                        <button type="button" onclick="confirm('Confirm Delete Foodtruck id {{$selected_id}}? \nDeleted Foodtrucks cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$selected_id}})" class="btn btn-danger" data-bs-dismiss="modal">Deny & Delete</button>
                    </div>
                @endcan
                @can('foodtrucks.update')
                    <div class="col">
                        <button type="button" wire:click.prevent="approve({{$selected_id}})" class="btn btn-primary" data-bs-dismiss="modal">Approve</button>
                    </div>
                @endcan
            </div>
       </div>
    </div>
</div>
