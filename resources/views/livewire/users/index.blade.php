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
@endsection