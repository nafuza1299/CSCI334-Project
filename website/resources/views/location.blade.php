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
.yellow {
  background-color: yellow;
}
</style>
<section>
    <body>
        <div class="container block-7 mb-5">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="col-md-12 d-flex align-items-end">
					<div class="text">
						<h1  style="font-size:40px !important">Location by COVID-19 infection</h1>
					</div>
				</div>
                <div class="col-md-12 d-flex align-items-end">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Location</th>
                                <th scope="col">Number of cases</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $data)
                                <tr>
                                    <th scope="row">
                                        <div class="row-status">
                                        @if($data['positive'] < 5)
                                            <div class='box green'></div>
                                            <span>Safe</span>
                                        @elseif($data['positive'] >= 5)
                                            <div class='box yellow'></div>
                                            <span>Mild</span>
                                        @elseif($data['positive'] >= 10)
                                            <div class='box red'></div>
                                            <span>Severe</span>
                                        @endif
                                        </div>
                                    </th>
                                    <td>{{ $data['address'] }}</td>
                                    <td>{{ $data['positive'] }}</td>
                                    <td>{{ $data['latitude'] }}</td>
                                    <td>{{ $data['longitude'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
       
    </body>
</section>
@endsection
