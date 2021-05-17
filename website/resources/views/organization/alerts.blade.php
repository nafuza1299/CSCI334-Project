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
                <div class="row">
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="text">
                            <h1  style="font-size:40px !important">Alerts</h1>
                            <h2>Hi, {{{Auth::guard('business')->user()->name}}}</h2>
                            <h4>Edit Alerts</h4>
                        </div>
                    </div>
                    <div class="col-md-6 text-right justify-content-md-end">
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alertsModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->
                    @if(Auth::guard('business')->user()->type == 'Health')
                        <button type="button" class="btn btn-white py-2 px-4 mt-3" data-toggle="modal" data-target="#alertsModal">Update Alerts</button>
                    @endif
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
                            @foreach(Auth::guard('business')->user()->notifications as $notification)
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
		</div>
    </body>
</section>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        window.unreadNotifications=0;
        user_id = {{auth()->guard('business')->id()}}
        $("#notif_count").html('<i class="fa fa-bell"></i>');
        $("#notif_count").attr("disabled","true");
        var new_alert;
        Echo.private('App.Models.Business.' + user_id)
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
@if(Auth::guard('business')->user()->type == 'Health')
    @section('javascript')
        <script type="text/javascript">
            $('#alertsModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var recipient = button.data('whatever') 
            })
        </script>
    @endsection
    @section('modal')
    <div class="modal fade" id="alertsModal" tabindex="-1" role="dialog" aria-labelledby="alertsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="alertsModalLabel">New Alert</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('business.create.alerts') }}" id="post-alert">
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <select class="form-control form-control-lg empty select-recipient" name="type">
                            <option value="" selected disabled hidden>Select Recipient</option>
                            <option value="Public">Public</option>
                            <option value="Staff">Organization's Health Staff</option>
                            <option value="Business">Business</option>
                        </select>          
                    </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Alert Message:</label>
                    <textarea class="form-control" id="message-text" name="message" placeholder="Alert Message" required></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="post-alert">Send Message</button>
        </div>
        </div>
    </div>
    </div>
    @endsection
    @yield('modal')
@endif