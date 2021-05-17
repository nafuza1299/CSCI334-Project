@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
		<!-- https://getbootstrap.com/docs/4.0/components/dropdowns/#menu-forms -->
		@guest('business')
		<div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; width: 600px !important">
            <h3> Sign up for a free organization account</h3>
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
            <form class="px-4 py-3" method="POST" action="{{ route('business.register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required placeholder="Organization Name" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="username" class="form-control" type="text" name="username" :value="old('username')" required placeholder="Username" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="phone_number" class="form-control" type="number" name="phone_number" :value="old('phone_number')" required placeholder="Phone Number"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="type" class="form-control" type="text" name="type" :value="old('type')" placeholder="Organization Type"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="password" class="form-control" type="password" name="password" required placeholder="Password" />		
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="Re-type Password"/>			
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <input type="checkbox" class="" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                Remember me
                            </label>
                    </div> -->

                    <div class="col-md-12">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-button class="btn btn-primary py-3 px-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
                <!-- <div></div>
                <a class="dropdown-item" href="#">Forgot password?</a>	 -->
        </div>
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