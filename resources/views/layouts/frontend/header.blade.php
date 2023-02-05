<?php

use App\Category;
use App\Logo;

$frontend = Logo::where('place', 'Homepage')->orderBy('id', 'desc')->first();
$categories = Category::orderBy('category')->get();
?>
<header id="site-header" class="site-header header-v4 color-black bg-white">
    <div class="header-mobile">
        <div class="section-padding">
            <div class="section-container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-left">
                        <div class="navbar-header">
                            <button type="button" id="show-megamenu" class="navbar-toggle"></button>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 header-center">
                        <div class="site-logo">
                            <a href="/">
                                <img width="400" height="79" src="{{$frontend->logo}}" alt="4space" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-right">
                        <div class="ruper-topcart dropdown">
                            <div class="dropdown mini-cart top-cart">
                                <div class="remove-cart-shadow"></div>
                                <a class="dropdown-toggle cart-icon" href="#" role="button">
                                    <div class="icons-cart"><i class="icon-large-paper-bag"></i><span class="cart-count">2</span></div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-mobile-fixed">
            <!-- Shop -->
            <div class="shop-page">
                <a href="{{route('all.products')}}"><i class="wpb-icon-shop"></i></a>
            </div>

            <!-- Login -->
            <div class="my-account">
                <div class="login-header">
                    <a href="{{route('login')}}"><i class="wpb-icon-user"></i></a>
                </div>
            </div>


            <!-- Wishlist -->
            <div class="wishlist-box">
                <a href="{{route('wishlists')}}"><i class="wpb-icon-heart"></i></a>
            </div>
        </div>
    </div>

    <div class="header-desktop">
        <div class="header-top">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 header-left">
                            <div class="header-page-link">
                                <!-- Search -->
                                <div class="search-box">
                                    <a data-toggle="modal" data-target="#search"><i class="icon-search"></i></a>
                                </div>

                            </div>

                            <div class="modal fade" id="search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Search Your Products</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <nav class="navbar navbar-light bg-light">
                                                        <form class="form-inline" method="get" action="{{route('search.product')}}">
                                                            @csrf
                                                            <div class="col-md-12">

                                                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="name">
                                                                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                                                        </form>
                                                </div>

                                                </nav>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 text-center header-center">
                        <div class="site-logo">
                            <a href="/">
                                <img width="400" height="79" src="{{asset($frontend->logo)}}" alt="4space" />
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 header-right">
                        <div class="header-page-link">
                            <!-- Login -->
                            <div class="login-header icon">
                                <a href="{{route('login')}}"><i class="icon-user"></i></a>

                            </div>

                            <!-- Wishlist -->
                            <div class="wishlist-box">
                                <a href="{{route('wishlists')}}"><i class="icon-heart"></i></a>
                                <span class="count-wishlist">1</span>
                            </div>

                            <!-- Cart -->
                            <div class="ruper-topcart dropdown light">
                                <div class="dropdown mini-cart top-cart">
                                    <div class="remove-cart-shadow"></div>
                                    <a class="dropdown-toggle cart-icon" href="{{route('cart')}}">
                                        <div class="icons-cart"><i class="icon-large-paper-bag"></i><span class="cart-count">2</span></div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-wrapper">
        <div class="section-padding">
            <div class="section-container p-l-r">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                        <div class="site-navigation">
                            <nav id="main-navigation">
                                <ul id="menu-main-menu" class="menu">
                                    <li class="level-0 menu-item">
                                        <a href="/"><span class="menu-item-text">Home</span></a>
                                    </li>
                                    <li class="level-0 menu-item menu-item-has-children">
                                        <a href="#"><span class="menu-item-text">Categories</span></a>

                                        <ul class="sub-menu">
                                            @foreach($categories as $category)
                                            @if( $category->sub_category->isNotEmpty())
                                            <li class="level-1 menu-item menu-item-has-children">
                                                <a href="{{route('subcategory',[$category->id,$category->category])}}"><span class="menu-item-text text-capitalize">{{$category->category}}</span></a>
                                                @foreach($category->sub_category as $subcategory)
                                                <ul class="sub-menu">
                                                    @if( $subcategory->sub_sub_category->isNotEmpty())

                                                    <li class="level-2 menu-item menu-item-has-children">
                                                        <a href="{{route('subsubcategory',[$subcategory->id,$subcategory->sub_category])}}"><span class="menu-item-text text-capitalize">{{$subcategory->sub_category}}</span></a>
                                                        <ul class="sub-menu">
                                                            @if($subcategory->sub_sub_category->isNotEmpty())
                                                            @foreach($subcategory->sub_sub_category as $subsubCategory)

                                                            <li class=" menu-item">
                                                                <a href="{{route('subsub_category.product',[$subsubCategory->id,$subsubCategory->sub_sub_category])}}"><span class="menu-item-text text-capitalize">{{$subsubCategory->sub_sub_category}}</span></a>
                                                            </li>
                                                            @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                    @else
                                                    <li>
                                                        <a href="{{route('sub_category.product',[$subcategory->id,$subcategory->sub_category])}}"><span class="menu-item-text">{{$subcategory->sub_category}}</span></a>
                                                    </li>
                                                    @endif
                                                </ul>
                                                @endforeach
                                            </li>
                                            @else
                                            <li>
                                                <a href="{{route('category.product',[$category->id,$category->category])}}"><span class="menu-item-text">{{$category->category}}</span></a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="level-0 menu-item">
                                        <a href="{{route('all.products')}}"><span class="menu-item-text">Products</span></a>
                                    </li>
                                    <li class="level-0 menu-item">
                                        <a href="mailto:sales@4space.com.sa"><span class="menu-item-text">Contact</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>