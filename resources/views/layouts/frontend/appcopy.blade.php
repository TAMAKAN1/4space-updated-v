<?php

use App\Logo;

$frontend = Logo::where('place', 'Homepage')->orderBy('id', 'desc')->first();
?>
<!DOCTYPE html>
<html lang="en">


<head>

    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" content="4space" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="4space" />
    <meta name="description" content="4space" />

    <!-- title  -->
    <title>4space</title>
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset($frontend->logo)}}">
    <link rel="apple-touch-icon" href="{{asset($frontend->logo)}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset($frontend->logo)}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset($frontend->logo)}}">

    <!-- plugins -->
    <link rel="stylesheet" href="{{asset('css/plugins.css')}}">

    <!-- revolution slider css -->
    <link rel="stylesheet" href="{{asset('css/rev_slider/settings.css')}}">
    <link rel="stylesheet" href="{{asset('css/rev_slider/layers.css')}}">
    <link rel="stylesheet" href="{{asset('css/rev_slider/navigation.css')}}">

    <!-- theme core css -->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    @yield('style')
</head>

<body>

    <!-- PAGE LOADING
    ================================================== -->
    <div id="preloader"></div>

    <!-- MAIN WRAPPER
    ================================================== -->
    <div class="main-wrapper mp-pusher" id="mp-pusher">

        <!-- HEADER
        ================================================== -->
        @include('layouts.frontend.header')

        <!-- CATEGORY MP-MENU
        ================================================== -->
        @include('layouts.frontend.category')



        @yield('content')





        <!-- FOOTER
        ================================================== -->
        @include('layouts.frontend.footer')

    </div>

    <!-- SCROLL TO TOP
    ================================================== -->
    <a href="#" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>

    <!-- all js include start -->

    <!-- jQuery -->
    <script src="{{asset('js/jquery.min.js')}}"></script>

    <!-- popper js -->
    <script src="{{asset('js/popper.min.js')}}"></script>

    <!-- bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- core.min.js -->
    <script src="{{asset('js/core.min.js')}}"></script>
    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- revolution slider js files start -->
    <script src="{{asset('js/rev_slider/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.actions.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.migration.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script src="{{asset('js/rev_slider/extensions/revolution.extension.video.min.js')}}"></script>
    <!-- revolution slider js files end -->

    <!-- theme core scripts -->
    <script src="{{asset('js/main.js')}}"></script>

    <!-- all js include end -->
    @yield('script')

</body>



</html>