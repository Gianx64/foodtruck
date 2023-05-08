<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Event</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="name"></label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="date"></label>
                        <input wire:model.defer="date" type="date" class="form-control" id="date" placeholder="Date">
                        @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="address"></label>
                        <input wire:model.defer="address" type="text" class="form-control" id="address" placeholder="Address">
                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description"></label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description" placeholder="Description">
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="map"></label>
                        <input wire:model="map" type="file" class="form-control" id="map">
                        @error('map') <span class="error text-danger">{{ $message }}</span> @enderror
                        <br><div wire:loading wire:target="map" >Loading image...</div>
                        @if($map)
                            <img src="{{ $map->temporaryUrl() }}" width=460>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save, map" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Event</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model.defer="selected_id">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner email:</label>
                        <input wire:model.defer="owner" type="text" class="form-control" id="owner" placeholder="Owner" readonly>
                        @error('owner') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input wire:model.defer="date" type="date" class="form-control" id="date" placeholder="Date">
                        @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input wire:model.defer="address" type="text" class="form-control" id="address" placeholder="Address">
                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description" placeholder="Description">
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="map">Map:</label>
                        <input wire:model="map" type="file" class="form-control" id="map">
                        @error('map') <span class="error text-danger">{{ $message }}</span> @enderror
                        @if($dbmap)
                            <br><h5>Stored map:</h5>
                            <img src="{{ asset($dbmap) }}" width=460>
                        @endif
                        <br><br><div wire:loading wire:target="map" >Loading image...</div>
                        @if($map)
                            <h5>Current map:</h5>
                            <img src="{{ $map->temporaryUrl() }}" width=460>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" wire:loading.attr="disabled" wire:target="save, map" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>
