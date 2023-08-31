@extends('layouts.app')
@section('title', __('User Update'))
@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-md-12">
							@livewire('self-update')
						</div>
					</div>
					<br>
					<div class="row justify-content-center">
						<div class="col-md-12">
							@can('foodtrucks.create')
								@livewire('foodtrucks')
							@endcan
							@if(auth()->user()->roles == '[]')
								<p>Please verify your email to register your foodtrucks.</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop