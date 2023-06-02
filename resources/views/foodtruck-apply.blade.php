@extends('layouts.app')
@section('title', __('Foodtruck Apply'))
@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						@livewire('foodtruck-apply', [$id])
					</div>
				</div>
			</div>
		</div>
	</div>
@stop