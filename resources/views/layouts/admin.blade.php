<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}"/>
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Adiguna Tupperware</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/material-dashboard.css?v=1.2.0')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/bootstrap.min.css') }} " rel="stylesheet"/>
    <!-- Animation library for notifications -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet"/>
    <!--     Fonts and icons-->
     <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet"/>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="wrapper">

    @include('layouts.sidemenu')

    <div class="main-panel">
        @include('layouts.navbar')

        @yield('konten')

        @include('layouts.footer')
    </div>
</div>
</body>
<!--   Core JS Files   -->
<style >
    .modal-content {
        max-width: calc(100vh - 212px);
        max-height: calc(100vh - 152px);
        overflow-y: auto;}
</style>
<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/material.min.js')}}" type="text/javascript"></script>
<!--  PerfectScrollbar Library -->
<script src="{{asset('assets/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('assets/js/material-dashboard.js?v=1.2.0')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="{{asset('assets/js/chartist.min.js')}}"></script>
<script src="{{asset('assets/js/arrive.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>
</html>
