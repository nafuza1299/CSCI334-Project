@extends('layouts.layouts')
@section('content')
<style>

.table-wrapper {
    width: 700px;
    margin: 30px auto;
    background: #fff;
    padding: 20px;	
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
}
.table-title h2 {
    margin: 6px 0 0;
    font-size: 22px;
}
.table-title .add-new {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
}
.table-title .add-new i {
    margin-right: 4px;
}

table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table th:last-child {
    width: 100px;
}
table.table td a {
    cursor: pointer;
    display: inline-block;
    margin: 0 5px;
    min-width: 24px;
}    
table.table td a.add {
    color: #27C46B;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}
table.table td a.add i {
    font-size: 24px;
    margin-right: -1px;
    position: relative;
    top: 3px;
}    
table.table .form-control {
    height: 32px;
    line-height: 32px;
    box-shadow: none;
    border-radius: 2px;
}
table.table .form-control.error {
    border-color: #f50000;
}
table.table td .add {
    display: none;
}
</style>
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
                        <form id="edit-business" class="px-4 py-3" method="POST" action="{{ route('business.edit.profile') }}">
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
                    <div class="container block-7 " style="background-color:#FFF; border: 1px solid black !important; !important">
                        <form id="insert-address" method="POST" action="{{route('business.insert.address')}}">
                            @csrf
                            <h3>Edit Business Address</h3>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <x-input id="address" class="form-control" type="text" name="address" required placeholder="Address"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <x-input id="latitude" class="form-control" type="text" name="latitude" required placeholder="Latitude"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <x-input id="longitude" class="form-control" type="text" name="longitude" required placeholder="Longitude"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <x-button class="btn btn-primary py-3 px-4">
                                        {{ __('Insert New Address') }}
                                    </x-button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <form id="delete-address" method="POST" action="{{route('business.delete.address')}}">
                                @csrf
                                <input type="hidden" id="id_delete" class="form-control" name="id"/>
                            </form>
                            <form id="edit-address" method="POST" action="{{route('business.edit.address')}}">
                                @csrf
                                <input type="hidden" id="id_edit" class="form-control" name="id"/>
                                <input type="hidden" id="address_edit" class="form-control" name="address"/>
                                <input type="hidden" id="latitude_edit" class="form-control" name="latitude"/>
                                <input type="hidden" id="longitude_edit" class="form-control" name="longitude"/>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($address as $data)
                                        <tr value="{{$data->id}}">
                                            <td name="address" type="text">{{$data->address}}</td>
                                            <td name="latitude" type="decimal">{{$data->latitude}}</td>
                                            <td name="longitude" type="decimal">{{$data->longitude}}</td>
                                            <td>
                                                <a class="add" title="Add" data-toggle="tooltip" onclick=""><i class="fa fa-plus"></i></a>
                                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <a class="delete" title="Delete"  data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</body>
</section>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Add row on add button click
	$(document).on("click", ".add", function(){
        var input_value = [];
        var input_id =  $(this).parents("tr").attr("value");
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
                input_value.push($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");

            $("#id_edit").val(input_id);
            $("#address_edit").val(input_value[0]);	
            $("#latitude_edit").val(input_value[1]);	
            $("#longitude_edit").val(input_value[2]);
            document.getElementById('edit-address').submit()

		}
        console.log(input_value)

        $("#id_edit").val(input_id);
        $("#address_edit").val(input_value[0]);	
        $("#latitude_edit").val(input_value[1]);	
        $("#longitude_edit").val(input_value[2]);		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        var input_id =  $(this).parents("tr").attr("value");
        $("#id_delete").val(input_id);
        document.getElementById('delete-address').submit()
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});
</script>
@endsection