@extends('layouts.app')
@section('title', __('Names'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            @livewire('food-types')
                            <br>
                            @livewire('document-names')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection