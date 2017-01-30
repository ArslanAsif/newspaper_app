<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GCC Connect | User Submission</title>

    <!-- Bootstrap -->
    <link href="{{url('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    @yield('css')

    <!-- Custom Theme Style -->
    <link href="{{url('admin/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><i class="fa fa-pencil"></i> <span>User Submission</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{ url('admin/images/img.jpg') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Author</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li>.</li>
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Back to Homepage</a></li>

                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        @yield('content')
    </div>
</div>

<!-- jQuery -->
<script src="{{ url('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ url('vendors/nprogress/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ url('vendors/Chart.js/dist/Chart.min.js') }}"></script>
<!-- jQuery Sparklines -->
<script src="{{ url('vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- Flot -->
<script src="{{ url('vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ url('vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ url('vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ url('vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ url('vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ url('vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
<script src="{{ url('vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ url('vendors/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ url('vendors/DateJS/build/date.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ url('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ url('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('admin/js/ajaxCall.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ url('admin/js/custom.min.js') }}"></script>

@yield('js')


</body>
</html>