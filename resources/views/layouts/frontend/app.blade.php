<?php
use App\Logo;

$frontend = Logo::where('place', 'Homepage')->orderBy('id', 'desc')->first()
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4space</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($frontend->logo)}}">

    <!-- Dependency Styles -->
    <link rel="stylesheet" href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/feather-font/css/iconfont.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/icomoon-font/css/icomoon.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/font-awesome/css/font-awesome.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/wpbingofont/css/wpbingofont.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/elegant-icons/css/elegant.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/slick/css/slick.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/slick/css/slick-theme.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('libs/mmenu/css/mmenu.min.css')}}" type="text/css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" type="text/css">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@100;200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;display=swap" rel="stylesheet">
    @yield('style')
</head>

<body class="home home-12 title-12">
    <div id="page" class="hfeed page-wrapper">
        @include('layouts.frontend.header')

        <div id="site-main" class="site-main">
            <div id="main-content" class="main-content">
                <div id="primary" class="content-area">
                    @yield('content')
                </div><!-- #primary -->
            </div><!-- #main-content -->
        </div>

        @include('layouts.frontend.footer')


    </div>

    <!-- Back Top button -->
    <div class="back-top button-show">
        <i class="arrow_carrot-up"></i>
    </div>

    <!-- Search -->
    <div class="search-overlay">
        <div class="close-search"></div>
        <div class="wrapper-search">
            <form role="search" method="get" class="search-from ajax-search" action="#">
                <div class="search-box">
                    <button id="searchsubmit" class="btn" type="submit">
                        <i class="icon-search"></i>
                    </button>
                    <input id="myInput" type="text" autocomplete="off" value="" name="s" class="input-search s" placeholder="Search...">


                </div>
            </form>
        </div>
    </div>



    <!-- Page Loader -->
    <div class="page-preloader">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Dependency Scripts -->
    <script src="{{asset('libs/popper/js/popper.min.js')}}"></script>
    <script src="{{asset('libs/jquery/js/jquery.min.js')}}"></script>
    <script src="{{asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('libs/slick/js/slick.min.js')}}"></script>
    <script src="{{asset('libs/countdown/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('libs/mmenu/js/jquery.mmenu.all.min.js')}}"></script>

    <!-- Site Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    @yield('script')

</body>


</html>