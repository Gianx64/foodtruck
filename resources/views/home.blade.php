@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css">
<div class="container">
    <div class="sidebar">
        @can('users.read')
        <a class="active" href="{{ route('users.index') }}">Users</a>
        @endcan
        @can('roles.read')
        <a href="{{ route('roles.index') }}">Roles</a>
        @endcan
        @can('events.read')
        <a href="{{ route('events.index') }}">Events</a>
        @endcan
        @can('foodtrucks.read')
        <a href="{{ route('foodtrucks.index') }}">Foodtrucks</a>
        @endcan
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection