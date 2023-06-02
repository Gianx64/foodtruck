@extends('layouts.app')
@section('title', __('Events'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('events')
            </div>
        </div>
    </div>
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
        addModal.hide();
        editModal.hide();
        })
    </script>
@endsection