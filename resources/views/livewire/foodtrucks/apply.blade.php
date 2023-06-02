<div class="card">
	<div class="card-header">
		<div style="display: flex; justify-content: space-between; align-items: center;">
			<div class="col-10">
				<h4>Applying for event: {{ $event_name }}</h4>
			</div>
			<div class="col">
				<a class="btn btn-primary mr-2 float-right" href="{{ route('events.show', $event_id) }}">Go Back</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="form-group container-fluid">
            <form>
                @csrf
                @include('errors')
                <input wire:model="event_id" type="hidden" id="event_id" name="event_id">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Foodtruck name:</label>
                        <input wire:model="name" type="text" class="form-control" id="name" name="name" placeholder="Name of the foodtruck" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="plate">License plate:</label>
                        <input wire:model="plate" type="text" class="form-control" id="plate" name="plate" placeholder="Foodtruck vehicle license plate" required>
                        @error('plate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="owner">Owner email:</label>
                        <input wire:model="owner" type="email" class="form-control" id="owner" name="owner" placeholder="Owner email" required>
                        @error('owner')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="food">Food type:</label>
                        <select wire:model="food" class="form-control" name="food" id="food" >
                            @foreach($foodtypes as $foodtype)
                                <option value="{{$foodtype}}">{{$foodtype}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="documents">Foodtruck documents (select multiple files by holding the "Control" key):</label>
                        <input type="file" wire:model="documents" class="form-control" multiple>
                        @error('documents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="description">Description:</label>
                        <textarea wire:model="description" type="text" class="form-control" id="description" name="description" cols=50
                        placeholder="Foodtruck description (extra details, warnings, links, etc.)"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br><button type="button" wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="save, documents" class="btn btn-primary">Submit</button>
            </form>
		</div>
	</div>
</div>