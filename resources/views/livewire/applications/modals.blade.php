<script type="module">
    const reviewModal = new bootstrap.Modal('#reviewDataModal');
    window.addEventListener('closeModal', () => {
    reviewModal.hide();
    })
</script>

<!-- Review Modal -->
<div wire:ignore.self class="modal fade" id="reviewDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Review Foodtruck</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<form>
                    <div class="row">
                        <div class="form-group col">
                            <label for="event_id">Event ID:</label>
                            <input wire:model="event_id" type="text" class="form-control" id="event_id" placeholder="Event ID" readonly>
                        </div>
                        <div class="form-group col">
                            <label for="event_name">Event Name:</label>
                            <input wire:model="event_name" type="text" class="form-control" id="event_name" placeholder="Event Name" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plate">License Plate:</label>
                        <input wire:model="plate" type="text" class="form-control" id="plate" placeholder="Plate" readonly>
                    </div>
                    <div class="form-group">
                        <label for="foodtruck_name">Foodtruck Name:</label>
                        <input wire:model="foodtruck_name" type="text" class="form-control" id="foodtruck_name" placeholder="Name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner Email:</label>
                        <input wire:model="owner" type="text" class="form-control" id="owner" placeholder="Owner" readonly>
                    </div>
                    <div class="form-group">
                        <label for="food">Food:</label>
                        <ul>
                            @foreach($foods as $single)
                                <li>{{$single}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="documents">Required documents:</label>
                            @if($documents != '[]' && $documents != null)
                                <ul>
                                    @foreach($documents as $document)
                                        <li>{{$document}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @error('documents') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col">
                            <label for="approved">Approved documents:</label>
                            @if($approved != '[]' && $approved != null)
                                <ul>
                                    @foreach($approved as $document)
                                        <li><a class="nav-link" href="{{Storage::url($document->file)}}" target="_blank" rel="noopener noreferrer">{{$document->document_name}}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No documents approved.</p>
                            @endif
                            @error('approved') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
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
                        <button type="button" onclick="confirm('Confirm delete application id {{$selected_id}}? \nDeleted applications cannot be recovered!')||event.stopImmediatePropagation()"
                        wire:click="destroy({{$selected_id}})" class="btn btn-danger" data-bs-dismiss="modal">Deny & Delete</button>
                    </div>
                @endcan
                @can('foodtrucks.update')
                    <div class="col">
                        <button type="button" wire:click.prevent="update()" class="btn btn-primary">Approve</button>
                    </div>
                @endcan
            </div>
       </div>
    </div>
</div>