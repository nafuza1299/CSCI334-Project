<div class="wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-4 d-flex align-items-center">
				<p class="mb-2 mt-2 phone pl-md-2">
					<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a> 
					<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
				</p>
			</div>
			<div class="col-md-6 d-flex align-items-center">
				<p class="mb-2 mt-2 phone pl-md-2" >
					<a style="color:black">
						<b>Visit our </b>
					</a>
					<a href="#" style="color:black"><b><u>news page</u></b></a>
					<a style="color:black">
						<b>for the latest on COVID-19 updates in Australia</b>
					</a>
				</p>
			</div>
			<!-- <div class="col-md-6 d-flex justify-content-md-end">
				<div class="social-media">
				<p class="mb-0 d-flex">
					<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
					<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
					<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
					<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
				</p>
			</div> -->
		</div>
	</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light mb-5" id="ftco-navbar">
	<div class="container">
		<div class="row">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
			</button>
			<div class="col-md-12">
				<div class="collapse navbar-collapse" id="ftco-nav">
					<div class="container">
						<div class="row">
							<div class="col-md-8 d-flex align-items-center">
								<a class="navbar-brand" href="{{url('/')}}">COVID19 Tracker</a>
								<ul class="navbar-nav">
									<li class="nav-item {{ Request::segment(1) === NULL ? 'active' : null }}"><a href="{{url('/')}}" class="nav-link">Home</a></li>
									<li class="nav-item {{ Request::segment(1) === 'quick-check-in' ? 'active' : null }}"><a href="{{url('quick-check-in')}}" class="nav-link">Quick Check In</a></li>
									<li class="nav-item {{ Request::segment(1) === 'news' ? 'active' : null }}"><a href="{{url('news')}}" class="nav-link">News</a></li>
								</ul>
							</div>
							<div class="col-md-4 d-flex justify-content-md-end">
									<a type="button" href="{{route('alerts')}}" class="icon-button mr-3 px-4 mt-2">
											<i class="fa fa-bell"></i>
										<span class="icon-button__badge">2</span>
									</a>
									@guest
									<p>
										<a href="{{ route('login') }}" class="btn btn-white py-2 px-4 mt-3">Log In</a>
										<a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 mt-3">Register</a> 
									</p>
									@endguest

									@auth
									<form method="POST" action="{{ route('logout') }}">
										<p>

											<a class="btn btn-white py-2 px-4 mt-3">Welcome {{{Auth::user()->name}}}</a> 
												@csrf
														<x-button class="btn btn-primary py-2 px-4 mt-3">
															{{ __('Log Out') }}
														</x-button>
												<!-- <x-dropdown-link :href="route('logout')"
														onclick="event.preventDefault();
																	this.closest('form').submit();">
													{{ __('Log out') }}
												</x-dropdown-link> -->
										</p>
										</form>
									@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				@auth
				<div class="collapse navbar-collapse" id="ftco-nav" >
					<ul class="navbar-nav" style="font-weight:600 !important">
						<li class="nav-item {{ Request::segment(1) === 'overview' ? 'active' : null }}"><a href="{{url('overview')}}" class="nav-link">Overview</a></li>
						<li class="nav-item {{ Request::segment(1) === 'alerts' ? 'active' : null }}"><a href="{{url('alerts')}}" class="nav-link">Alerts</a></li>
						<li class="nav-item {{ Request::segment(1) === 'vaccine' ? 'active' : null }}"><a href="{{url('vaccine')}}" class="nav-link">COVID-19 Vaccine</a></li>
						<li class="nav-item {{ Request::segment(1) === 'history' ? 'active' : null }}"><a href="{{url('history')}}" class="nav-link">Check-In History</a></li>
						<li class="nav-item {{ Request::segment(1) === 'profile' ? 'active' : null }}"><a href="{{url('profile')}}" class="nav-link">Manage Account</a></li>
					</ul>
				</div>
				@endauth
			</div>
		</div>		
	</div>
</nav>
<!-- END nav -->