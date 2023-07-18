@extends('layouts.app')
@section('title', __('Documents'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @livewire('documents')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection