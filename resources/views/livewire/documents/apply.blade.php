<div>
    @include('livewire.documents.modals')
	@if (session()->has('message'))
	<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
	@endif
    <a data-bs-toggle="modal" data-bs-target="#documentDataModal" class="btn btn-sm btn-secondary"><i class="fa fa-plus"></i>Add Document</a>
</div>