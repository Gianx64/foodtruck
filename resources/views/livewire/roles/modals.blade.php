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
                <h5 class="modal-title" id="createDataModalLabel">Create New Role</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="name"></label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
					<br><h4>Permissions List:</h4>
					@foreach ($permissions as $permission)
						<div>
							<input type="checkbox" wire:click="checkPermission({{$permission->id}})" id="{{$permission->id}}" name="{{$permission->name}}">
							<label for="{{$permission->id}}" class="h5">{{$permission->name}}</label><br>
						</div>
					@endforeach
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
                <h5 class="modal-title" id="updateModalLabel">Update Role</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="name"></label>
                        <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
					<br><h4>Permissions List:</h4>
					@foreach ($permissions as $permission)
						<div>
							<input type="checkbox" wire:click="checkPermission({{$permission->id}})" id="{{$permission->id}}" name="{{$permission->name}}" @if(in_array($permission->id, $permissions_selected)) checked="checked" @endif>
							<label for="{{$permission->id}}" class="h5">{{$permission->name}}</label><br>
						</div>
					@endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>