
<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Página não encontrada - Sistema de Gestão de Ginásio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type=" {{ url('painel/image/png" href="assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ url('painel/assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ url('painel/css/style.css')}}">
    <!-- modernizr css -->
    <script src="{{ url('painel/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- error area start -->
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
                <h2>404</h2>
                <p>Ooops! Não conseguimos encontrar a página solicitada.</p>
                <a href="{{ route('home') }}">Voltar no painel</a>
            </div>
        </div>
    </div>
    <!-- error area end -->

    <!-- jquery latest version -->
    <script src="{{ url('painel/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('painel/assets/js/popper.min.js')}}"></script>
    <script src="{{ url('painel/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ url('painel/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ url('painel/assets/js/metisMenu.min.js')}}"></script>
    <script src="{{ url('painel/assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ url('painel/assets/js/jquery.slicknav.min.js')}}"></script>
    
    <!-- others plugins -->
    <script src="{{ url('painel/assets/js/plugins.js') }}"></script>
    <script src="{{ url('painel/assets/js/scripts.js') }}"></script>
</body>

</html>