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
							<div class="col-md-6 d-flex align-items-center">
								<a class="navbar-brand" href="{{route('business')}}">COVID19 Tracker Organization</a>
								<ul class="navbar-nav">
									<li class="nav-item {{ Request::segment(2) === NULL ? 'active' : null }}"><a href="{{route('business')}}" class="nav-link">Home</a></li>
									<li class="nav-item {{ Request::segment(2) === 'location' ? 'active' : null }}"><a href="{{route('business.location')}}" class="nav-link">Location</a></li>
									<li class="nav-item {{ Request::segment(2) === 'news' ? 'active' : null }}"><a href="{{route('business.news')}}" class="nav-link">News</a></li>
								</ul>
							</div>
							<div class="col-md-6 d-flex justify-content-md-end">
							<!-- business side login/logout -->
								@guest('business')
										<p>
											<a href="{{ route('business.login') }}" class="btn btn-white py-2 px-4 mt-3">Log In</a>
											<a href="{{ route('business.register') }}" class="btn btn-primary py-2 px-4 mt-3">Register</a> 
										</p>
								@endguest
								@auth('business')
									<a type="button" href="{{route('business.alerts')}}" class="icon-button mr-3 px-4 mt-2" id="notif_count">
										<i class="fa fa-bell"></i>
											@if(count(Auth::guard('business')->user()->unreadNotifications) > 0)
												<span class="icon-button__badge">{{count(Auth::guard('business')->user()->unreadNotifications)}}</span>
											@endif
											
									</a>
									<form method="POST" action="{{ route('business.logout') }}">
											<a class="btn btn-white py-2 px-4 mt-3" href="{{route('business.profile')}}">Welcome {{{Auth::guard('business')->user()->username}}}</a> 
												@csrf
											<x-button class="btn btn-primary py-2 px-4 mt-3">
												{{ __('Log Out') }}
											</x-button>
									</form>
								@endauth
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
			@auth('business')
				<div class="collapse navbar-collapse" id="ftco-nav" >
					<ul class="navbar-nav" style="font-weight:600 !important">
						<li class="nav-item {{ Request::segment(2) === 'overview' ? 'active' : null }}"><a href="{{route('business.overview')}}" class="nav-link">Overview</a></li>
						<li class="nav-item {{ Request::segment(2) === 'alerts' ? 'active' : null }}"><a href="{{route('business.alerts')}}" class="nav-link">Alerts</a></li>
						<li class="nav-item {{ Request::segment(2) === 'generate-qr-code' ? 'active' : null }}"><a href="{{route('business.generate.qr')}}" class="nav-link">Generate QR-Code</a></li>
						@if(Auth::guard('business')->user()->type == 'Business')
						<li class="nav-item {{ Request::segment(2) === 'safe-registration' ? 'active' : null }}"><a href="{{route('business.safe.registration')}}" class="nav-link">Safe Registration</a></li>
						@endif
						<li class="nav-item {{ Request::segment(2) === 'report' ? 'active' : null }}"><a href="{{route('business.report')}}" class="nav-link">Report</a></li>
						<li class="nav-item {{ Request::segment(2) === 'profile' ? 'active' : null }}"><a href="{{route('business.profile')}}" class="nav-link">Manage Account</a></li>
					</ul>
				</div>
				@endauth
			</div>
		</div>		
	</div>
</nav>
<!-- END nav -->
