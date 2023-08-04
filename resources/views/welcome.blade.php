@extends('layouts.app')
@section('title', __('Welcome'))
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5><span class="text-center fa fa-home"></span>@yield('title')</h5></div>
                    <div class="card-body">
                        <h5>{{ __('Welcome to') }} {{ config('app.name', 'Laravel') }}
                            @auth
                                , {{ Auth::user()->name }}
                            @endif
                            . Today is {{date("Y-m-d")}}.
                        </h5>
                        <hr>
                        @livewire('events')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection