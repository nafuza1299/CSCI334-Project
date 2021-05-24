@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
		<!-- https://getbootstrap.com/docs/4.0/components/dropdowns/#menu-forms -->
		@guest
			@section('modal')
				@include('auth.public.register')
			@endsection
		@endguest
		<div class="container mb-5">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="row">
					<div class="col-md-6 ftco-animate d-flex align-items-end mb-5">
						<div class="text w-100">
							<h1 class="mb-4">Stay safe with the new COVID-19 APP</h1>
							@guest
								<p class="mb-4">Sign up now to track your activities and prevent COVID19 contact</p>
								<p><a href="{{route('login')}}" class="btn btn-white py-3 px-4">Log In</a> <a href="{{route('register')}}" class="btn btn-primary py-3 px-4">Register</a></p>
							@endguest
						</div>
					</div>
						@guest
						<div class="col-md-6 ftco-animate d-flex align-items-end text-right mb-5">
							<div class="text w-100">
									<p class="mb-4">Looking to use the application for business use? Use the COVID19 App for Public</p>
									<p><a href="{{route('business')}}" class="btn btn-primary py-3 px-4">COVID-19 Tracker Business</a></p>
							</div>
						</div>
						@endguest
					<div class="col-md-12">
						<div class="row no-gutters">
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
											<h4><b>Contact Tracing</b></h4>
											<p>Keep track of where to go and where not to go with the contact tracing feature that will show safes areas and red zones</p>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
										<h4><b>Vaccine Roll-Out</b></h4>
										<p>Stay up to date to receive your COVID-19 Vaccine to get the COVID-19 Vaccination Certificate to enable you to connect back with the world</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
										<h4><b>COVID-19 Alerts</b></h4>
										<p>Get notifications on new rules and regulations, new COVID-19 cases and hotspots, and vaccine rollouts in Australia.</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
										<h4><b>COVID-19 Safe Check In</b></h4>
										<p>Use the COVID-19 Safe Check In to enter any venue in Australia in order to keep yourself and the community safe</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <a href="https://vimeo.com/45830194" class="img-video popup-vimeo d-flex align-items-center justify-content-center">
						<span class="fa fa-play"></span>
					</a> -->
				</div>
			</div>
		</div>
	</body>
</section>
@endsection