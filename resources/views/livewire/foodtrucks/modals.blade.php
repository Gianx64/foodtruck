<!-- Add & Edit Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if($foodtruck_name == null)
                <h5 class="modal-title" id="createDataModalLabel">Create New Foodtruck</h5>
                @else
                <h5 class="modal-title" id="updateModalLabel">Update Foodtruck</h5>
                @endif
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="foodtruck_name"></label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name" placeholder="Foodtruck's name">
                        @error('foodtruck_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="plate"></label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" placeholder="Plate">
                        @error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food"></label>
                        <select wire:model.defer="food" class="form-control" name="food" id="food" placeholder="Select a food type">
                            @foreach($foodtypes as $foodtype)
                                <option value="{{$foodtype}}">{{$foodtype}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description"></label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description" placeholder="Description">
                        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                @if($foodtruck_name == null)
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
                @else
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Update</button>
                @endif
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
                        <label for="foodtruck_name"></label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name" placeholder="Foodtruck's name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="plate"></label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" placeholder="Plate">@error('plate') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="food"></label>
                        <select wire:model.defer="food" class="form-control" name="food" id="food" placeholder="Select a food type">
                            @foreach($foodtypes as $foodtype)
                                <option value="{{$foodtype}}">{{$foodtype}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description"></label>
                        <input wire:model.defer="description" type="text" class="form-control" id="description" placeholder="Description">@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
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