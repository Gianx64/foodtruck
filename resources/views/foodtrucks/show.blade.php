@extends('layouts.app')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2>Reviewing Foodtruck</h2>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-primary" href="{{ route('foodtrucks.index') }}">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('events.show', $foodtruck->event_id) }}">Go to event</a>
                        <div class="form-group">
                            <strong>Event ID:</strong>
                            {{ $foodtruck->event_id ?? 'Event ID not found' }}
                        </div>
                        <div class="form-group">
                            <strong>Foodtruck Name:</strong>
                            {{ $foodtruck->name ?? 'Name not found' }}
                        </div>
                        <div class="form-group">
                            <strong>Owner Email:</strong>
                            {{ $foodtruck->owner ?? 'Email not found' }}
                        </div>
                        <div class="form-group">
                            <strong>License Plate:</strong>
                            {{ $foodtruck->plate ?? 'License plate not found' }}
                        </div>
                        <div class="form-group">
                            <strong>Food type:</strong>
                            {{ $foodtruck->food ?? 'Food type not found' }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $foodtruck->description ?? 'Description not found' }}
                        </div>
                        <div class="row">
                            @can('foodtrucks.update')
                                <div class="col-1">
                                    <a href="{{route('foodtrucks.accept', $foodtruck)}}" class="btn btn-primary">Accept</a>
                                </div>
                            @endcan
                            @can('foodtrucks.delete')
                                <div class="col">
                                    <form action="{{route('foodtrucks.destroy', $foodtruck)}}" class="swal-delete" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Deny & Delete</button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection