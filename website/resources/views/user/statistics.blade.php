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
                            <h1  style="font-size:40px !important">Statistics</h1>
                            <h2>Hi, {{{Auth::user()->name}}}</h2>
                            <h4>View Statistics</h4>
                        </div>
                    </div>
                    <div class="col-md-6 text-right justify-content-md-end">
                    </div>
                    <div class="col-md-12 d-flex align-items-end">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Number of cases</th>
                                <th scope="col">Number of deaths </th>
                                <th scope="col">Number of recovered</th>
                                </tr>
                            </thead>
                            <tbody id="alert_notif">
                            @foreach($org_statistics as $data)
                                <tr>
                                    <td>{{$data->infect_total}}</td>
                                    <td>{{$data->death_total}}</td>
                                    <td>{{$data->recovered_total}}</td>
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
