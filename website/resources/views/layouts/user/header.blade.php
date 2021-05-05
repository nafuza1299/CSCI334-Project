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
							<div class="col-md-8 d-flex align-items-center">
								<a class="navbar-brand" href="{{route('home')}}">COVID19 Tracker</a>
								<ul class="navbar-nav">
									<li class="nav-item {{ Request::segment(1) === NULL ? 'active' : null }}"><a href="{{route('home')}}" class="nav-link">Home</a></li>
									<li class="nav-item {{ Request::segment(1) === 'quick-check-in' ? 'active' : null }}"><a href="{{route('quick-check-in')}}" class="nav-link">Quick Check In</a></li>
									<li class="nav-item {{ Request::segment(1) === 'news' ? 'active' : null }}"><a href="{{route('news')}}" class="nav-link">News</a></li>
								</ul>
							</div>
							<div class="col-md-4 d-flex justify-content-md-end">
								<!-- web side login/logout -->
								@guest
									<p>
										<a href="{{ route('login') }}" class="btn btn-white py-2 px-4 mt-3">Log In</a>
										<a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 mt-3">Register</a> 
									</p>
								@endguest
								@auth
									<a type="button" href="{{route('alerts')}}" class="icon-button mr-3 px-4 mt-2" id="notif_count">
											<i class="fa fa-bell"></i>
											@if(count(Auth::user()->unreadNotifications) > 0)
												<span class="icon-button__badge">{{count(Auth::user()->unreadNotifications)}}</span>
											@endif
									</a>
									<form method="POST" action="{{ route('logout') }}">
										<p>

											<a class="btn btn-white py-2 px-4 mt-3" href="{{route('profile')}}">Welcome {{{Auth::user()->name}}}</a> 
												@csrf
											<x-button class="btn btn-primary py-2 px-4 mt-3">
												{{ __('Log Out') }}
											</x-button>
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
						<li class="nav-item {{ Request::segment(1) === 'overview' ? 'active' : null }}"><a href="{{route('overview')}}" class="nav-link">Overview</a></li>
						<li class="nav-item {{ Request::segment(1) === 'alerts' ? 'active' : null }}"><a href="{{route('alerts')}}" class="nav-link">Alerts</a></li>
						<li class="nav-item {{ Request::segment(1) === 'vaccine' ? 'active' : null }}"><a href="{{route('vaccine')}}" class="nav-link">COVID-19 Vaccine</a></li>
						<li class="nav-item {{ Request::segment(1) === 'history' ? 'active' : null }}"><a href="{{route('history')}}" class="nav-link">Check-In History</a></li>
						<li class="nav-item {{ Request::segment(1) === 'profile' ? 'active' : null }}"><a href="{{route('profile')}}" class="nav-link">Manage Account</a></li>
					</ul>
				</div>
				@endauth
			</div>
		</div>		
	</div>
</nav>
<!-- END nav -->
