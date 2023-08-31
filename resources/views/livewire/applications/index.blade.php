@extends('layouts.app')
@section('title', __('Applications'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @livewire('applications')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection