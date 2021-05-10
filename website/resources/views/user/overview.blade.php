@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
		<div class="container">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="col-md-6 d-flex align-items-end">
					<div class="text">
						<h1  style="font-size:40px !important">Overview</h1>
						<h2>Hi, {{{Auth::user()->name}}}</h2>
					</div>
				</div>
			</div>
		</div>
		<section class="ftco-section ">
			<div class="container ml-5"> 
				<div class="row">
					<div class="col-md-6 d-flex align-items-stretch ftco-animate">
						<div class="services-2">
							<div class="icon-wrap">
								<div class="number d-flex align-items-center justify-content-center"><span>01</span></div>
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="flaticon-calendar"></span>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-center text-justify">
								<ul style="list-style-type: none !important;">
									<li><h2>Last Check In</h2></li>
									<li>Location: @isset($last_checkin_data[0]) {{$last_checkin_data[0]->address}} @else N/A @endisset</li>
									<li>Checked In: @isset($last_checkin_data[0]) {{$last_checkin_data[0]->check_in_time}} @else N/A @endisset</li>
									<!-- <li>Checked Out: 28/03/21 11:02</li>	 -->
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-items-stretch ftco-animate">
						<div class="services-2">
							<div class="icon-wrap">
								<div class="number d-flex align-items-center justify-content-center"><span>02</span></div>
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="flaticon-qa"></span>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-center text-justify">
								<ul style="list-style-type: none !important;">
									<li><h2>Last COVID-19 Test</h2></li>
									<li>Test Result: Negative</li>
									<li>Test Location: Barden Ridge Test Facility</li>
									<li>Test Date: 17/3/21</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</section>
@endsection