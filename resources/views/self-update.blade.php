@extends('layouts.app')
@section('title', __('User Update'))
@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						@livewire('self-update')
					</div>
					<br>
					<div class="row justify-content-center">
						@can('foodtrucks.create')
							@livewire('foodtrucks')
						@endcan
					</div>
				</div>
			</div>
		</div>
	</div>
@stop