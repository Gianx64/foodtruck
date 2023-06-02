@extends('layouts.app')
@section('title', __('Users'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('users')
            </div>     
        </div>   
    </div>
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        const assignModal = new bootstrap.Modal('#assignDataModal');
        window.addEventListener('closeModal', () => {
        addModal.hide();
        editModal.hide();
        assignModal.hide();
        })
    </script>
@endsection