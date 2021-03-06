<!DOCTYPE html>
<html lang="en">
<head>
    <title>COVID19 Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>
  <body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">
    @if(Request::is('organization*') )
      @include('layouts.organization.header')
    @else
      @include('layouts.user.header')
    @endif
    <div class="content-wrapper">
      @yield('modal')
      @yield('content')
    </div>
    @include('layouts.footer')
  </div>
  
    <!-- Scripts -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('assets/js/scrollax.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{asset('assets/js/google-map.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/qrcode.min.js')}}"></script>

    <script src="{{asset('js/app.js')}}"></script>
    @auth   
      <script>
        $(document).ready(function() {
          user_id = {{auth()->id()}};
          window.unreadNotifications = {{count(auth()->user()->unreadNotifications)}};
          var alert_count;
          Echo.private('App.Models.User.' + user_id)
          .notification((notification) => {
            if ($("#notif_count").attr("disabled") == undefined) {
              window.unreadNotifications++;
              alert_count ='<i class="fa fa-bell"></i>'+'<span class="icon-button__badge">'+unreadNotifications+'</span>';
              $("#notif_count").html(alert_count);
             }
          });
        });
      </script>
    @endauth
    @auth('business')   
      <script>
        $(document).ready(function() {
          user_id = {{auth()->guard('business')->id()}};
          window.unreadNotifications = {{count(auth()->guard('business')->user()->unreadNotifications)}};
          var alert_count;
          Echo.private('App.Models.Business.' + user_id)
          .notification((notification) => {
            if ($("#notif_count").attr("disabled") == undefined) {
              window.unreadNotifications++;
              alert_count ='<i class="fa fa-bell"></i>'+'<span class="icon-button__badge">'+unreadNotifications+'</span>';
              $("#notif_count").html(alert_count);
             }
          });
        });
      </script>
    @endauth
    @yield('javascript')
</body>
