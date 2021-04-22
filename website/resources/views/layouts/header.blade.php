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
		</div>

		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="{{url('home')}}">COVID19 Tracker</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav">
				<li class="nav-item {{ Request::segment(1) === 'home' ? 'active' : null }}"><a href="{{url('home')}}" class="nav-link">Home</a></li>
				<li class="nav-item {{ Request::segment(1) === 'about' ? 'active' : null }}"><a href="{{url('about')}}" class="nav-link">Quick Check In</a></li>
				<li class="nav-item {{ Request::segment(1) === 'counselor' ? 'active' : null }}"><a href="{{url('counselor')}}" class="nav-link">News</a></li>
				<li class="nav-item {{ Request::segment(1) === 'services' ? 'active' : null }}"><a href="{{url('services')}}" class="nav-link">Services</a></li>
				<li class="nav-item {{ Request::segment(1) === 'pricing' ? 'active' : null }}"><a href="{{url('pricing')}}" class="nav-link">Pricing</a></li>
				<li class="nav-item {{ Request::segment(1) === 'blog' ? 'active' : null }}"><a href="{{url('blog')}}" class="nav-link">Blog</a></li>
				<li class="nav-item {{ Request::segment(1) === 'contact' ? 'active' : null }}"><a href="{{url('contact')}}" class="nav-link">Contact</a></li>
			</ul>
			</div>
			<div class="collapse navbar-collapse justify-content-md-end" id="ftco-nav">
				<p>
					<a href="{{ route('login') }}" class="btn btn-white py-2 px-4 mt-3">Log In</a>
					<a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 mt-3">Register</a> 
				</p>
			</div>
		</div>
		</nav>
		<!-- END nav -->