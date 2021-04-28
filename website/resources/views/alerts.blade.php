@extends('layouts.layouts')
@section('content')
<style>
.row-status {
    display : flex;
    align-items : center;
}
.box {
  height: 20px;
  width: 40px;
  margin-right : 5px;
}
.yellow {
  background-color: yellow;
}

</style>
<section>
    <body>
        <div class="container">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="col-md-6 d-flex align-items-end">
					<div class="text">
						<h1  style="font-size:40px !important">Check In History</h1>
						<h2>Hi, {{{Auth::user()->name}}}</h2>
                        <h4>Edit Alerts</h4>
					</div>
				</div>
                <div class="col-md-12 d-flex align-items-end">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Alert</th>
                            <th scope="col">Message</th>
                            <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">
                                <div class="row-status">
                                    <div class='box yellow'></div>
                                    <span>COVID-19 Cases Update</span>
                                </div>
                            </th>
                            <td>0 COVID-19 cases were recorded in your area</td>
                            <td>21/3/21</td>
                            </tr>
                            <tr>
                            <th scope="row">
                                <div class="row-status">
                                    <div class='box yellow'></div>
                                    <span>COVID-19 Cases Update</span>
                                </div>
                            </th>
                            <td>0 COVID-19 cases were recorded in your area</td>
                            <td>21/3/21</td>
                            </tr>
                            <tr>
                            <th scope="row">
                                <div class="row-status">
                                    <div class='box yellow'></div>
                                    <span>COVID-19 Cases Update</span>
                                </div>
                            </th>
                            <td>0 COVID-19 cases were recorded in your area</td>
                            <td>21/3/21</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
        <div class="container mb-5">	

         
            </div>
    </body>
</section>
@endsection
