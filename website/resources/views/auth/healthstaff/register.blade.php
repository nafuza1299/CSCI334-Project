@extends('layouts.layouts')
@section('content')
<section>
    <body>
        <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; width: 600px !important">
            <h3> Sign up for a health staff account</h3>
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
            <form class="px-4 py-3" method="POST" action="{{ route('healthstaff.register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required placeholder="Username" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input id="first_name" class="form-control" type="text" name="first_name" :value="old('first_name')" required placeholder="First Name" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input id="last_name" class="form-control" type="text" name="last_name" :value="old('last_name')" required placeholder="Last Name" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Email"/>
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
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('healthstaff.login') }}">
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
