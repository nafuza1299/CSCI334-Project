@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
		<!-- https://getbootstrap.com/docs/4.0/components/dropdowns/#menu-forms -->
		@guest('business')
			@section('modal')
				@include('auth.business.register')
			@endsection
		@endguest
		<div class="container mb-5">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="row">
					<div class="col-md-6 ftco-animate d-flex align-items-end mb-5">
						<div class="text w-100">
							<h1 class="mb-4">Track your organization COVID-19 history</h1>
							@guest('business')
								<p class="mb-4">Sign up now to track your organization  activities and prevent COVID19 contact</p>
								<p>
									<a href="{{route('business.login')}}" class="btn btn-white py-3 px-4">Log In</a> 
									<a href="{{route('business.register')}}" class="btn btn-primary py-3 px-4">Register</a>
								</p>
							@endguest
						</div>
					</div>
					@guest('business')
					<div class="col-md-6 ftco-animate d-flex align-items-end text-right mb-5">
						<div class="text w-100">
								<p class="mb-4">Looking to use the application for private use? Use the COVID19 App for Public</p>
								<p><a href="{{route('home')}}" class="btn btn-primary py-3 px-4">COVID-19 Tracker Public</a></p>
						</div>
					</div>
					@endguest
					<div class="col-md-12">
						<div class="row no-gutters">
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
											<h4><b>Contact Tracing</b></h4>
											<p>Keep track of who and when enters your organization areas with the contact tracing feature that will show safes areas and red zones</p>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
										<h4><b>Generate QR-Code</b></h4>
										<p>Create your own custom QR code for the public to scan at your organization location</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
									<h4><b>Safe Regisration</b></h4>
										<p>Register and verify your organization as COVID-19 safe</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="text-left">
									<div class="text">
										<h4><b>Generate Report</b></h4>
										<p>Generate a report on people that were on your organization premises</p>
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