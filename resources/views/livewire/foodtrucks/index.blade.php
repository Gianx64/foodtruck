@extends('layouts.app')
@section('title', __('Foodtrucks'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('foodtrucks')
            </div>     
        </div>   
    </div>
    <script type="module">
        const reviewModal = new bootstrap.Modal('#reviewDataModal');
        window.addEventListener('closeModal', () => {
        reviewModal.hide();
        })
    </script>
@endsection