<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - NewsUp</title>
    <meta name="description" content="Angle - Blog is a clean and minimalist photography blog perfectly designed for photographers and bloggers. Slimply is beautiful, clean and very classic design.">
    <meta name="keywords" content="photoblog, portfolio, photography, photographer, unique, creative, blog, minimal, beautiful theme">
    <meta name="author" content="Laza Themes">

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ url('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ url('img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/apple-touch-icon-114x114.png') }}">

    <!-- Bootstrap
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/jasny-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('fonts/font-awesome-4.7.0/css/font-awesome.css') }}">

    <!-- Animate
    ================================================== -->
    <link href="{{ url('css/effect2.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ url('css/animate.css') }}" rel='stylesheet' type='text/css'>

    <!-- Add fancyBox CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ url('js/fancybox/jquery.fancybox8cbb.css?v=2.1.5') }}" media="screen" />

    <!-- Owl Slider CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/owl.carousel.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/owl.theme.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/owl.transitions.css') }}" media="screen" />

    <!-- Custom Css
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/rs-wp-v1.2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/jquery.rs.selectbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/my-stylesheet.css') }}">

    <!-- Custom Fonts
   ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ url('fonts/stylesheet.css') }}">

    <!-- Google Fonts
    ================================================== -->
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!--- Wrapper -->
<section id="wrapper" class="clearfix">

    @include('includes.nav')

    @yield('content')

    <!--- Footer -->
    <footer>
        <div class="rst-footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 rst-copyright">
                        <p>© 2015 Sportis. All rights reserved.</p>
                    </div>
                    <div class="col-xs-6 rst-design">
                        <p>Developed by Quantum Bridge <a href="#"><i class="fa fa-angle-up"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer><!--- End Footer -->

</section><!--- End Wrapper -->

<!--Share buttons plugin-->
<!-- Go to www.addthis.com/dashboard to customize your tools --> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5875e2c4b6ef8618"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="{{ url('js/jquery-1.11.3.js') }}"></script>

<!-- Bootstrap Js Compiled Plugins -->
<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/bootstrap-tagsinput.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jqBootstrapValidation.js') }}"></script>

<!-- WoW Js -->
<script type="text/javascript" src="{{ url('js/wow.min.js') }}"></script>

<!-- Add Fancybox -->
<script type="text/javascript" src="{{ url('js/fancybox/jquery.fancybox8cbb.js?v=2.1.5') }}"></script>
<script type="text/javascript" src="{{ url('js/fancybox/helpers/jquery.fancybox-mediac924.js?v=1.0.6') }}"></script>

<!-- Owl Slider Js -->
<script type="text/javascript" src="{{ url('js/owl.carousel.js') }}"></script>

<!-- Weather Js -->
<script type="text/javascript" src="{{ url('js/jquery.simpleWeather.js') }}"></script>

<!-- Custome Selectbox Js -->
<script type="text/javascript" src="{{ url('js/jquery.rs.selectbox.js') }}"></script>

<script type="text/javascript" src="{{ url('js/main.js') }}"></script>

</body>

</html>