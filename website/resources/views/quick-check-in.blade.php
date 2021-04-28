@extends('layouts.layouts')
@section('content')
<section>
    <body>
        <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; width: 600px !important">
         <h3>COVID-19 Safe Check In</h3>
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
            <form class="px-4 py-3" method="POST">
                @csrf
                <div class="row">
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
                            <x-input id="contact" class="form-control" type="text" name="contact" :value="old('contact')" required placeholder="Contact"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="venue" class="form-control" type="text" name="venue" :value="old('venue')" required placeholder="Venue"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-button class="btn btn-primary py-3 px-4">
                                {{ __('Check In') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</section>
@endsection
