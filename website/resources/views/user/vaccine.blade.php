@extends('layouts.layouts')
@section('content')
@auth 
<section class="content-header">
	<body>
		<div class="container">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="col-md-6 d-flex align-items-end">
					<div class="text">
						<h1 style="font-size:40px !important">COVID-19 Vaccine Rollout</h1>
						<h2>Hi, {{{Auth::user()->name}}}</h2>
					</div>
				</div>
			</div>
		</div>
		<section class="ftco-section ">
			<div class="container"> 
				<div class="row">
					<div class="col-md-6 d-flex align-items-stretch ftco-animate">
						<div class="services-2">
							<div class="icon-wrap">
								<div class="number d-flex align-items-center justify-content-center"><span>01</span></div>
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-medkit"></span>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-center text-center">
								<ul style="list-style-type: none !important;">
									<li><h2>COVID-19 Vaccine Ready</h2></li>
									<li>You are currently not eligible to get the COVID-19 vaccine </li>
									<li>Refer to the rollout plan below to see when you are eligible</li>	
								</ul>
							</div>
							<div class="d-flex align-items-center justify-content-center mt-2">
								<p><a href="https://www.health.gov.au/initiatives-and-programs/covid-19-vaccines" class="btn btn-white py-3 px-4">Get Ready</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-items-stretch ftco-animate">
						<div class="services-2">
							<div class="icon-wrap">
								<div class="number d-flex align-items-center justify-content-center"><span>02</span></div>
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-paperclip"></span>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-center text-center">
								<ul style="list-style-type: none !important;">
									<li><h2>COVID-19 Vaccine Certificate</h2></li>
									<li>You currently do not have a COVID-19 vaccine certificate</li>
								</ul>
							</div>
							<div class="d-flex align-items-center justify-content-center mt-2">
								<p><a href="{{route('vaccine.certificate')}}" class="btn btn-white py-3 px-4">More Info</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</section>
		<div class="container">
			<div class="row justify-content-center pb-5">
				<div class="col-md-10 heading-section text-center ftco-animate">
					<h2>The COVID-19 Vaccine Roll Out is Here</h2>
					<h3>Learn when you will get your COVID-19 Vaccine and be prepared on where to go and what to bring</h3>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row no-gutters">
				<div class="col-md-6">
					<div class="text-left align-items-end">
						<div class="text">
							<ul style="list-style-type: none !important;">
								<li><h4><b>Phase 1a</b></h4></li>
								<li>Quarantine, border and front line health care workers </li>
								<li>Frontline health care worker sub-groups for prioritisation</li>
								<li>Aged care and disability care staff</li>
								<li>Aged care and disability care residents</li>	
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-right align-items-end">
						<div class="text">
							<ul style="list-style-type: none !important;">
								<li><h4><b>Phase 2a</b></h4></li>
								<li>Adults aged 60-69 years</li>
								<li>Adults aged 50-59 years</li>
								<li>Continue vaccinating Aboriginal and Torres Strait Islander adults</li>
								<li>Other critical and high risk workers</li>
								<li>Aged care and disability care residents</li>	
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-left align-items-end">
						<div class="text">
							<ul style="list-style-type: none !important;">
								<li><h4><b>Phase 1b</b></h4></li>
								<li>Elderly adults aged 80 years and over</li>
								<li>Elderly adults aged 70-79 years</li>
								<li>Other health care workers</li>
								<li>Aboriginal and Torres Strait Islander adults 55 and over</li>
								<li>Adults with an underlying medical condition or significant disability</li>	
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-right align-items-end">
						<div class="text">
							<ul style="list-style-type: none !important;">
								<li><h4><b>Phase 2b</b></h4></li>
								<li>Balance of adult population</li>
								<li>Catch up any unvaccinated Australians from previous phases</li>
								<li><h4><b>Phase 3</b></h4></li>
								<li>< 16 if recommended*</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<section class="ftco-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 wrap-about px-md-5 ftco-animate py-5">
						<div class="heading-section py-md-5">
							<h2 class="mb-4">This video describes how vaccines will be rolled out, and who they will go to first.</h2>
						</div>
					</div>
					<div class="col-md-6 d-flex justify-content-center align-items-center" style="background-image: url(assets/images//about-1.jpg);">
						<a href="https://vimeo.com/45830194" class="img-video popup-vimeo d-flex align-items-center justify-content-center">
							<span class="fa fa-play"></span>
						</a>
					</div>
				</div>
			</div>
		</section>

	</body>
</section>
@endauth
@endsection