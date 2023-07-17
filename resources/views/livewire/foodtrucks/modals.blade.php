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

<!-- Add & Edit Modal -->
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
                        <label for="plate">Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate">
                        @error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name">
                        @error('foodtruck_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Food type:</label>
                        <select wire:model.defer="food" class="form-control" name="food" id="food">
                            @foreach($foodtypes as $foodtype)
                                <option value="{{$foodtype}}">{{$foodtype}}</option>
                            @endforeach
                        </select>
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
                        <label for="plate">Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate">
                        @error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name">
                        @error('foodtruck_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Food type:</label>
                        <select wire:model.defer="food" class="form-control" name="food" id="food">
                            @foreach($foodtypes as $foodtype)
                                <option value="{{$foodtype}}">{{$foodtype}}</option>
                            @endforeach
                        </select>
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
                        <input wire:model.defer="food" class="form-control" name="food" id="food" readonly>
                        @error('food') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <button type="button" wire:click.prevent="apply()" class="btn btn-primary">Apply!</button>
            </div>
        </div>
    </div>
</div>