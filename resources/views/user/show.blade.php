@extends('layouts.app')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}">Go Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>User Name:</strong>
                            {{ $user->name ?? 'User name not found' }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email ?? 'Email not found' }}
                        </div>
                        <div class="form-group">
                            <strong>Role:</strong>
                            {{ $user->role ?? 'User roles not found' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection