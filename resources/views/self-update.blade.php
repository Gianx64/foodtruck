@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="card">
							<div class="card-header">
								<div style="display: flex; justify-content: space-between; align-items: center;">
									<div class="col-10">
										<h4>Edit Profile</h4>
									</div>
									@can('events.read')
										<div class="col">
										    <a class="btn btn-primary mr-2 float-right" href="{{ route('home') }}">Home</a>
										</div>
									@endcan
								</div>
							</div>
							<div class="card-body">
                                @livewire('self-update')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop