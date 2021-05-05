@extends('layouts.layouts')
@section('content')
<section>
    <body>
        <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; width: 600px !important">
            <h3> Sign up for a free business account</h3>
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
            <form class="px-4 py-3" method="POST" action="{{ route('business.register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required placeholder="Business Name" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="username" class="form-control" type="text" name="username" :value="old('username')" required placeholder="Username" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Email"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="phone_number" class="form-control" type="number" name="phone_number" :value="old('phone_number')" required placeholder="Phone Number"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="type" class="form-control" type="text" name="type" :value="old('type')" placeholder="Business Type"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="password" class="form-control" type="password" name="password" required placeholder="Password" />		
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="Re-type Password"/>			
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <input type="checkbox" class="" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                Remember me
                            </label>
                    </div> -->

                    <div class="col-md-12">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-button class="btn btn-primary py-3 px-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
                <!-- <div></div>
                <a class="dropdown-item" href="#">Forgot password?</a>	 -->
        </div>
    </body>
</section>
@endsection
