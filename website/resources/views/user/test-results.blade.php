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
						<h1  style="font-size:40px !important">Test Results</h1>
						<h2>Hi, {{{Auth::user()->name}}}</h2>
					</div>
				</div>
                <div class="col-md-12 d-flex align-items-end">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Location</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test_results_data as $data)
                                <tr>
                                    <th scope="row">
                                        <div class="row-status">
                                            @if($data->infected)
                                                <div class='box red'></div>
                                                <span>Positive</span>

                                            @else
                                                <div class='box green'></div>
                                                <span>Negative</span>
                                            @endif
                                        </div>
                                    </th>
                                    <td>{{ $data->location }}</td>
                                    <td>{{ $data->test_date }}</td>
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
