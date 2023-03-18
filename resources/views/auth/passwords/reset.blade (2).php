@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
  <div class="row">
      <div class="col-8"> 
          <h1>Editar Usuario</h1>
      </div>
      <div class="col">
          <a class="btn btn-primary mr-2 float-right" href="{{ route('home') }}">Volver</a>
      </div>
  </div>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::model($user, ['route' => ['users.updateSelf'], 'method' => 'put']) !!}
                @include('errors')
                @include('user.form')
                {!! Form::submit('Ingresar', ['class' => 'btn btn-primary mt-2']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@stop