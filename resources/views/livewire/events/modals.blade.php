<script type="module">
    const addModal = new bootstrap.Modal('#createDataModal');
    const editModal = new bootstrap.Modal('#updateDataModal');
    window.addEventListener('closeModal', () => {
    addModal.hide();
    editModal.hide();
    })
</script>

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
                        <label for="name">Name:</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name" autocomplete="on" autofocus>
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner email:</label>
                        <input wire:model="owner" type="text" class="form-control" id="owner" placeholder="Owner">
                        @error('owner') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input wire:model.defer="date" type="datetime-local" class="form-control" id="date">
                        @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input wire:model.defer="address" type="text" class="form-control" id="address" placeholder="Address" autocomplete="on">
                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="slots">Slots for foodtrucks:</label>
                        <input wire:model.defer="slots" type="number" class="form-control" id="slots" placeholder="Foodtruck slots" value="1" min="1" max="99">
                        @error('slots') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="slots">Documents requred:</label>
                        <div style="display: flex;">
                            <select wire:model.defer="document" class="form-control" name="document" id="document">
                                @foreach($document_list as $document_name)
                                    <option value="{{$document_name}}">{{$document_name}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" wire:click="addName">Add/Remove</button>
                        </div>
                        <ul>
                            @foreach($documents as $single)
                                <li>{{$single}}</li>
                            @endforeach
                        </ul>
                        @error('documents') <span class="error text-danger">{{ $message }}</span> @enderror
                        @error('document') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">(Optional) Description:</label>
                        <textarea wire:model.defer="description" cols=55 type="text" id="description" name="description"
                        placeholder="Event description (extra details, warnings, links, etc.)"></textarea>
                        <!--input wire:model.defer="description" type="text" class="form-control" id="description" placeholder="Description"-->
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="map">Map:</label>
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
                        <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name" autocomplete="on" autofocus>
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner email:</label>
                        <input wire:model.defer="owner" type="text" class="form-control" id="owner" placeholder="Owner">
                        @error('owner') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input wire:model.defer="date" type="datetime-local" class="form-control" id="date">
                        @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input wire:model.defer="address" type="text" class="form-control" id="address" placeholder="Address" autocomplete="on">
                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="slots">Slots for foodtrucks:</label>
                        <input wire:model.defer="slots" type="number" class="form-control" id="slots" placeholder="Foodtruck slots" value="1" min="1" max="99">
                        @error('slots') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="slots">Documents requred:</label>
                        <div style="display: flex;">
                            <select wire:model.defer="document" class="form-control" name="document" id="document">
                                @foreach($document_list as $document_name)
                                    <option value="{{$document_name}}">{{$document_name}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" wire:click="addName">Add/Remove</button>
                        </div>
                        <ul>
                            @foreach($documents as $single)
                                <li>{{$single}}</li>
                            @endforeach
                        </ul>
                        @error('documents') <span class="error text-danger">{{ $message }}</span> @enderror
                        @error('document') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">(Optional) Description:</label>
                        <textarea wire:model.defer="description" cols=55 type="text" id="description" name="description"
                        placeholder="Event description (extra details, warnings, links, etc.)"></textarea>
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