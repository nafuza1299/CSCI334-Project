@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
    <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider-text align-items-center" style="height:inherit !important">
                        <div class="text">
                            <h1>{{{ucfirst(trans(Auth::guard('business')->user()->username))}}}'s Profile</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; !important">
                        <h3>Edit Profile</h3>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
                        <form class="px-4 py-3" method="POST" action="{{ route('business-edit-profile') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Business Name</label>
                                        <x-input id="name" class="form-control" type="text" name="name" :value="Auth::guard('business')->user()->name" required placeholder="Business Name" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <x-input id="email" class="form-control" type="email" name="email" :value="Auth::guard('business')->user()->email" required placeholder="Email"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <x-input id="address" class="form-control" type="text" name="address" :value="Auth::guard('business')->user()->address" placeholder="Address"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <x-input id="phone_number" class="form-control" type="number" name="phone_number" :value="Auth::guard('business')->user()->phone_number" placeholder="Phone Number"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">Business Type</label>
                                        <x-input id="type" class="form-control" type="string" name="type" :value="Auth::guard('business')->user()->type" placeholder="Business Type"/>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <x-input id="email" class="form-control" type="text" name="email" :value="Auth::guard('business')->user()->email" required placeholder="Email"/>
                                    </div>
                                </div> -->
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