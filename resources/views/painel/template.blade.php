<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('main-title-page')Sistema de Gestão de Ginásio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon"
        type="{{ url('painel/image/png" href="assets/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ url('painel/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('painel/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('painel/css/style.css') }}">
    @stack('css')
    <!-- modernizr css -->
    <script src="{{ url('painel/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
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
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('painel.partials.sidebar')
        <!-- sidebar menu area end -->
        @include('painel.partials.navegation')
        <!-- page title area start -->
        @include('painel.partials.header')
        <!-- page title area end -->
        <div class="main-content-inner">
            @yield('main-content')
        </div>
        <!-- row area start-->
    </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    @include('painel.partials.footer')
    <!-- footer area end-->
    <!-- MODAL -->
    @include('painel.partials.modal')

    <script src="{{ url('painel/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('painel/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('painel/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('painel/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('painel/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('painel/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('painel/assets/js/jquery.slicknav.min.js') }}"></script>


    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];

    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"
        integrity="sha512-AtJGnumoR/L4JbSw/HzZxkPbfr+XiXYxoEPBsP6Q+kNo9zh4gyrvg25eK2eSsp1VAEAP1XsMf2M984pK/geNXw=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    @stack('js')
    <!-- others plugins -->
    <script src="{{ url('painel/assets/js/plugins.js') }}"></script>
    <script src="{{ url('painel/assets/js/scripts.js') }}"></script>
    <script src="{{ url('painel/js/scripts.js') }}"></script>


    <script>
    /* Popular província */
    $(function () {
        $('#province').on('change', function (e) {
            var province_id = e.target.value;
            $('#municipe').empty();
            //Ajax
            $.get('/ajax-subcat?province_id=' + province_id, function (data) {
                $('#municipe').append(
                    '<option selected disabled>Selecionar município</option>')
                $.each(data, function (index, subcatObj) {
                    console.log(index)
                    $('#municipe').append('<option value="' + subcatObj.id +
                        '">' + subcatObj.name + '</option>')
                });
            });
        });
    });
    </script>


</body>

</html>
