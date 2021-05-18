@extends('layouts.layouts')
@section('content')
<style>
.row-status {
    display : flex;
    align-items : center;
}
.box {
  height: 20px;
  width: 40px;
  margin-right : 5px;
}
.yellow {
  background-color: yellow;
}

</style>
<section>
    <body>
        <div class="container block-7 mb-5">	
			<div class="slider-text align-items-center" style="height:inherit !important">
				<div class="col-md-6 d-flex align-items-end">
					<div class="text">
						<h1  style="font-size:40px !important">Alerts</h1>
						<h2>Hi, {{{Auth::user()->name}}}</h2>
                        <h4>View Alerts</h4>
					</div>
				</div>
                <div class="col-md-12 d-flex align-items-end">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Alert</th>
                            <th scope="col">Message</th>
                            <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody id="alert_notif">
                        @foreach(Auth::user()->notifications as $notification)
                            <tr>
                                <th scope="row">
                                    <div class="row-status">
                                        <div class='box yellow'></div>
                                        <span>{{$notification->data['type']}}</span>
                                    </div>
                                </th>
                                <td>{{$notification->data['message']}}</td>
                                <td>{{$notification->created_at->diffForHumans()}}</td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
    </body>
</section>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        window.unreadNotifications=0;
        user_id = {{auth()->id()}}
        $("#notif_count").html('<i class="fa fa-bell"></i>');
        $("#notif_count").attr("disabled","true");
        var new_alert;
        Echo.private('App.Models.User.' + user_id)
        .notification((notification) => {
            new_alert = ('<tr>'+
                        '<th scope="row">'+
                        ' <div class="row-status">'+
                                '<div class="box yellow"></div>'+
                                '<span>'+notification.msg_type+'</span>'+
                            '</div>'+
                        '</th>'+
                        '<td>'+notification.message+'</td>'+
                        '<td>'+moment().fromNow()+'</td>'+
                   '</tr>');
           $("#alert_notif").prepend(new_alert);
        });
    });
</script>
@endsection