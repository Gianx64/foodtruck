<script type="module">
    const addModal = new bootstrap.Modal('#createDataModal');
    const editModal = new bootstrap.Modal('#updateDataModal');
    const showModal = new bootstrap.Modal('#showDataModal');
    window.addEventListener('closeModal', () => {
    addModal.hide();
    editModal.hide();
    showModal.hide();
    })
</script>

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
                        <label for="plate">License Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" autofocus>
                        @error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's Name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name">
                        @error('foodtruck_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Food Type:</label>
                        <div style="display: flex;">
                            <select wire:model.defer="food" class="form-control" name="food" id="food">
                                @foreach($foodtypes as $foodtype)
                                    <option value="{{$foodtype}}">{{$foodtype}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" wire:click="addName">Add/Remove</button>
                        </div>
                        <ul>
                            @foreach($foods as $single)
                                <li>{{$single}}</li>
                            @endforeach
                        </ul>
                        @error('foods') <span class="error text-danger">{{ $message }}</span> @enderror
                        @error('food') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">(Optional) Description:</label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description">
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Foodtruck</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="plate">License Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" autofocus>
                        @error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's Name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name">
                        @error('foodtruck_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Food Type:</label>
                        <div style="display: flex;">
                            <select wire:model.defer="food" class="form-control" name="food" id="food">
                                @foreach($foodtypes as $foodtype)
                                    <option value="{{$foodtype}}">{{$foodtype}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" wire:click="addFood">Add/Remove</button>
                        </div>
                        <ul>
                            @foreach($foods as $single)
                                <li>{{$single}}</li>
                            @endforeach
                        </ul>
                        @error('foods') <span class="error text-danger">{{ $message }}</span> @enderror
                        @error('food') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">(Optional) Description:</label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description">
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Apply Modal -->
<div wire:ignore.self class="modal fade" id="showDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Show Foodtruck</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="plate">Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" readonly>
                        @error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                        @error('foodtruck_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name" readonly>
                        @error('foodtruck_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Food type:</label>
                        <ul>
                            @foreach($foods as $single)
                                <li>{{$single}}</li>
                            @endforeach
                        </ul>
                        @error('food') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="documents">Required documents:</label>
                            @if($documents != '[]' && $documents != null)
                                @if($documents[0] != "")
                                    <ul>
                                        @foreach($documents as $document)
                                            <li>{{$document}}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No documents required.</p>
                                @endif
                            @endif
                            @error('documents') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col">
                            <label for="approved">Approved documents:</label>
                            @if($approved != '[]' && $approved != null)
                                <ul>
                                    @foreach($approved as $document)
                                        <li>{{$document}}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No documents approved.</p>
                            @endif
                            @error('approved') <span class="error text-danger">{{ $message }}</span> @enderror
                            <a class="nav-link" href="{{ route('users.edit') }}">To add documents for review, click here.</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description" readonly>
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
                <br><a class="nav-link" href="{{ route('users.edit') }}">Is something wrong? Click here to edit foodtruck.</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Apply!</button>
            </div>
        </div>
    </div>
</div>