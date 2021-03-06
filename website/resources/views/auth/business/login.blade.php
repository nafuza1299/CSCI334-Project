@extends('layouts.layouts')
@section('content')
<section>
    <body>
        <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; max-width: 600px !important">
            <h3>Log in to your COVID-19 Safe <b>Organization Account</b></h3>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />  
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
            <form method="POST" action="{{ route('business.login') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="username" class="form-control" type="text" name="username" :value="old('username')" required placeholder="Username" autofocus/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password" />     
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2 d-flex align-items-center">
                            <label for="remember_me" class="d-flex align-items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-md-end mt-2">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-button class="btn btn-primary py-3 px-4">
                                {{ __('Log in') }}
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
