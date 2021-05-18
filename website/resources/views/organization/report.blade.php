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
        <div class="container block-7 mb-5">	
			<div class="slider-text align-items-center" style="height:inherit !important">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="text">
                            <h1  style="font-size:40px !important">Report</h1>
                            <h2>Hi, {{{Auth::guard('business')->user()->name}}}</h2>
                            <h4>View Report</h4>
                        </div>
                    </div>
                    <div class="col-md-6 text-right justify-content-md-end">
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Location</th>
                                <th scope="col">Number of People visited</th>
                                <th scope="col">Number of cases</th>
                                <th scope="col">Last Check In</th>
                                </tr>
                            </thead>
                            <tbody id="alert_notif">
                            @foreach($report_data as $data)
                                <tr>
                                    <td>{{$data["address"]}}</td>
                                    <td>{{$data["visited"]}}</td>
                                    <td>{{$data["positive"]}}</td>
                                    <td>{{$data["last_check"]}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
			    </div>
            </div>
		</div>
    </body>
</section>
@endsection
