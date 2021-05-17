@extends('layouts.layouts')
@section('content')
<section>
    <body>
        <div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; width: 600px !important">
            <h3> Sign up for a free organization account</h3>
            <x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
            <form class="px-4 py-3" method="POST" action="{{ route('business.register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required placeholder="Organization Name" />
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
                            <!-- <x-input id="type" class="form-control" type="text" name="type" :value="old('type')" placeholder="Organization Type"/> -->
                            <select class="form-control form-control-lg empty select-type" name="type" required placeholder="Organization Type">
                                <option  selected disabled hidden>Select Organization Type</option>
                                <option value="Business">Business</option>
                                <option value="Health">Health Organization</option>
                            </select>
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
                    <div class="col-md-12 mb-2 health-certificate" style="display:none;">
                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input" id="regis-upload" name="certificate">
                            <label class="custom-file-label" for="regis-upload">Choose file</label>
                        </div>
                    </div>
                    <div class="col-md-6 health-certificate" style="display:none;">
                        <div class="form-group">
                            <ul class="px-2"style="list-style-type: none !important;">
                                <li>One File Only</li>
                                <li>5 MB limit.</li>
                                <li>PDF, PNG, JPEG only</li>	
                            </ul>
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
@section("javascript")
<script>
	// Add the following code if you want the name of the file appear on select
	$("#regis-upload").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		var reader = new FileReader();
		var f = document.getElementById("regis-upload").files;
		reader.onloadend = function () {
            var result = reader.result.replace(/^data:.+;base64,/, '');
			$("#certificate").val(result)
			console.log($("#certificate").val())
		}
		reader.readAsDataURL(f[0]);
	});
    $('.select-type').on('change', function() {
        if($(this).val() == 'Business'){
            $(".health-certificate").hide();
        }
        else if($(this).val() == 'Health'){
            $(".health-certificate").show();
        }
    });
</script>
@endsection