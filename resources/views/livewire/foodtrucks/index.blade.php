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
@endsection