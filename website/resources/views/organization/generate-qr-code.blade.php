@extends('layouts.layouts')
@section('content')

<section>
    <body>
        @if(session()->has('qrcode'))
            <div class="container mb-5">
                <div class="text-center ">
                    <h3>Your QR Code has been generated </h3>
                    <div style="display: flex; justify-content: center; text-align: center;" id="qrcode"></div>
                <div>
            </div>
        @else
        <div class="container mb-5">
			<div class="row">
				<div class="col-md-12">
					<div class="slider-text align-items-center" style="height:inherit !important">
						<div class="text">
							<h1  style="font-size:40px !important">Safe Registration</h1>
							<h2>Hi, {{{Auth::guard('business')->user()->username}}}</h2>
						</div>
					</div>
				</div>
                <div class="col-md-12">
                    <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; max-width: 600px !important">
                        <h3>Generate a <b>QR Code</b> for your organization location</h3>
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
                        <form method="POST" action="{{ route('generate.qr.code') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="form-control form-control-lg empty select-address" name="id" required>
                                            <option value="" selected disabled hidden>Select Organization Address</option>
                                            @if(count($address) > 0)
                                                @foreach ($address as $data)
                                                    <option value="{{$data->id}}">{{$data->address}}</option>
                                                @endforeach
                                            @else
                                                <option value="redirect" href="{{route('business.profile')}}">Register Organization Address</option>
                                            @endif
                                        </select>
                                        <!-- <x-input id="username" class="form-control" type="text" name="username" :value="old('username')" required placeholder="Username" autofocus/> -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-button class="btn btn-primary py-3 px-4">
                                            {{ __('Generate QR Code') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>  
        </div>
        @endif
    </body>
</section>
@endsection
@section('javascript')
<script>
    $('.select-address').on('change', function() {
        if(this.value == "redirect" ){
            window.location = "{{route('business.profile')}}" // redirect
        }
    });
</script>
@if(session()->has('qrcode'))
    <script type="text/javascript">
        new QRCode(document.getElementById("qrcode"), "{{session('qrcode')}}");
    </script>
@endif
@endsection

