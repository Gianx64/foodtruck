@extends('layouts.app')
@section('title', __('Foodtypes'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @livewire('foodtypes')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection