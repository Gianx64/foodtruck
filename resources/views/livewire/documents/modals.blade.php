<script type="module">
    const docModal = new bootstrap.Modal('#documentDataModal');
    const reviewModal = new bootstrap.Modal('#reviewDataModal');
    window.addEventListener('closeModal', () => {
    docModal.hide();
    reviewModal.hide();
    })
</script>

<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="documentDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Document</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="plate">License Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's Name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="document_name">Document's Name:</label>
                        <input wire:model="document_name" type="text" class="form-control" id="document_name" placeholder="Document Name">
                        @error('document_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="expires">Expiration Date:</label>
                        <input wire:model="expires" type="date" class="form-control" id="expires" placeholder="Expires">
                        @error('expires') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Document File:</label>
                        <input wire:model="file" type="file" class="form-control" id="file" placeholder="File">
                        @error('file') <span class="error text-danger">{{ $message }}</span> @enderror
                        <br><div wire:loading wire:target="file" >Loading file...</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save, file" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div wire:ignore.self class="modal fade" id="reviewDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Review Document</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="plate">License Plate:</label>
                        <input wire:model.defer="plate" type="text" class="form-control" id="plate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck's Name:</label>
                        <input wire:model.defer="foodtruck_name" type="text" class="form-control" id="foodtruck_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="document_name">Document's Name:</label>
                        <input wire:model="document_name" type="text" class="form-control" id="document_name" placeholder="Document Name" readonly>
                        @error('document_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="expires">Expiration Date:</label>
                        <input wire:model="expires" type="date" class="form-control" id="expires" placeholder="Expires" readonly>
                        @error('expires') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Document File:</label>
                        <input wire:model="file" type="file" class="form-control" id="file" placeholder="File" readonly>
                        @error('file') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @can('documents.delete')
                    <div class="col-9">
                        <button type="button" onclick="confirm('Confirm delete document id {{$selected_id}}? \nDeleted documents cannot be recovered!')||event.stopImmediatePropagation()"
                        wire:click="destroy({{$selected_id}})" class="btn btn-danger" data-bs-dismiss="modal">Deny & Delete</button>
                    </div>
                @endcan
                @can('documents.update')
                    <div class="col">
                        <button type="button" wire:click.prevent="approve()" class="btn btn-primary" data-bs-dismiss="modal">Approve</button>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>