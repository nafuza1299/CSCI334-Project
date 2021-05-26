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
.green {
  background-color: green;
}
.red {
  background-color: red;
}
</style>
<section>
    <body>
        <div class="container block-7">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="col-md-6 d-flex align-items-end">
					<div class="text">
						<h1  style="font-size:40px !important">Check In History</h1>
						<h2>Hi, {{{Auth::user()->name}}}</h2>
					</div>
				</div>
                <div class="col-md-12 d-flex align-items-end table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Location</th>
                                <th scope="col">Time</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkin_data as $data)
                                <tr>
                                    <th scope="row">
                                        <div class="row-status">
                                            <div class='box green'></div>
                                            <span>Checked In</span>
                                        </div>
                                    </th>
                                    <td>{{ $data->address }}</td>
                                    <td>{{ $data->check_in_time }}</td>
                                    <td>{{ $data->latitude }}</td>
                                    <td>{{ $data->longitude }}</td>
                                </tr>
                            @endforeach
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
