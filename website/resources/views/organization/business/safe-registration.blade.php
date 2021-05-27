@extends('layouts.layouts')
@section('content')
<section class="content-header">
	<body>
		<div class="container mb-5">
			<div class="row">
				<div class="col-md-12">
					<div class="slider-text align-items-center" style="height:inherit !important">
						<div class="text">
							<h1  style="font-size:40px !important">Safe Registration</h1>
							<h2>Hi, {{{Auth::guard('business')->user()->username}}}</h2>
							@if(Auth::guard('business')->user()->verified == 0 &&  Auth::guard('business')->user()->certificate != NULL)
								<p>Pending Approval</p>
							@elseif(Auth::guard('business')->user()->verified == 1)
								<p>Approved</p>
							@endif
						</div>
					</div>
				</div>
				@if(Auth::guard('business')->user()->verified == 0)
				<div class="col-md-12">
					<div class="container block-7" style="background-color:#FFF; border: 1px solid black !important; max-width : 600px !important ">
						<h3>Register your organization as COVID-19 Safe</h3>
						<x-auth-validation-errors class="mb-4" :errors="$errors" style="color:red;" />
						<form method="POST" action="{{ route('business.upload.certificate') }}" id="certificate-upload" enctype="multipart/form-data">
							@csrf
							<!-- <input type="hidden" id="certificate" class="form-control" name="certificate"/> -->
							<div class="row">
								<div class="col-md-12 mb-2">
									<div class="form-group custom-file">
										<input type="file" class="custom-file-input" id="regis-upload" name="certificate">
										<label class="custom-file-label" for="regis-upload">Choose file</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<ul class="px-2"style="list-style-type: none !important;">
											<li>One File Only</li>
											<li>5 MB limit.</li>
											<li>PDF, PNG, JPEG only</li>	
										</ul>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<x-button class="btn btn-primary py-3 px-4" id="upload-file">
											{{ __('Upload') }}
										</x-button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				@endif
				@if(Auth::guard('business')->user()->certificate != NULL)
					<div class="col-md-12">
						<div class="container block-7 text-center" style="background-color:#FFF; border: 1px solid black !important; max-width : 600px !important ">
							<h3>View Registration</h3>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<a href="{{route('saferegistration.download')}}" class="btn btn-primary py-3 px-4">Download</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				@endif
				@if(session()->has('success'))
				<div class="col-md-12">
					<div class="text-center ">
						<h3>{{session('success')}}</h3>
					<div>
				</div>
				@endif
			</div>
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

	// $(document).on("click", "#upload-file", function(){
	// 	document.getElementById('certificate-upload').submit()
	// 	console.log($("#certificate").val())

	// })
</script>
@endsection