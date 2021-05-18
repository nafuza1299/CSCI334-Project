@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider-text align-items-center" style="height:inherit !important">
                        <div class="text">
                            <h1>{{{ucfirst(trans(Auth::user()->name))}}}'s Statistics</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; !important">
                        <h3>Edit Statistic</h3>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
                        <form class="px-4 py-3" method="POST" action="{{ route('business.healthorg.statistics') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="recovered">Recovered</label>
                                        <x-input id="recovered" class="form-control" type="text" name="recovered" value="{{$statistic->recovered}}" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="infected"> Infected</label>
                                        <x-input id="infected" class="form-control" type="text" name="infected" value="{{$statistic->infected}}" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deaths">Deaths</label>
                                        <x-input id="deaths" class="form-control" type="text" name="deaths" value="{{$statistic->deaths}}" required />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-button class="btn btn-primary py-3 px-4">
                                            {{ __('Edit') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</body>
</section>
@endsection