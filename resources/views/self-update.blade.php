@extends('layouts.app')
@section('title', __('User Update'))
@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						@livewire('self-update')
						@livewire('foodtruck')
					</div>
				</div>
			</div>
		</div>
	</div>
@stop