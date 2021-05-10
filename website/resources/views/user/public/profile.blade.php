@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
    <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider-text align-items-center" style="height:inherit !important">
                        <div class="text">
                            <h1>{{{ucfirst(trans(Auth::user()->name))}}}'s Profile</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; !important">
                        <h3>Edit Profile</h3>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
                        <form class="px-4 py-3" method="POST" action="{{ route('edit.profile') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <x-input id="first_name" class="form-control" type="text" name="first_name" :value="Auth::user()->first_name" required placeholder="First Name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <x-input id="last_name" class="form-control" type="text" name="last_name" :value="Auth::user()->last_name" required placeholder="Last Name" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <x-input id="email" class="form-control" type="email" name="email" :value="Auth::user()->email" required placeholder="Email"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <x-input id="address" class="form-control" type="text" name="address" :value="Auth::user()->address" placeholder="Address"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <x-input id="phone_number" class="form-control" type="number" name="phone_number" :value="Auth::user()->phone_number" placeholder="Phone Number"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <x-input id="date_of_birth" class="form-control" type="date" name="date_of_birth" :value="Auth::user()->date_of_birth" placeholder="Date of Birth"/>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <x-input id="email" class="form-control" type="text" name="email" :value="Auth::user()->email" required placeholder="Email"/>
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