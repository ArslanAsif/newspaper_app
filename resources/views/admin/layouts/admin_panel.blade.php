<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentellela Alela! | </title>

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
    <link href="{{url('css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ url('/admin/dashboard/') }}" class="site_title"><i class="fa fa-pencil"></i> <span>Admin Panel</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{ url('images/img.jpg') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>Administrator</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                @include('admin.includes.sidepanel')


            </div>
        </div>

        @include('admin.includes.navbar')

        @yield('content')

    <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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

<!-- Custom Theme Scripts -->
<script src="{{ url('js/custom.min.js') }}"></script>

@yield('js')


</body>
</html>