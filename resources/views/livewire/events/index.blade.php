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
@endsection