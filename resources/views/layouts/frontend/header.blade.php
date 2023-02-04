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
                                <img width="400" height="79" src="{{asset($frontend->logo)}}" alt="4Space" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 header-right">
                        <div class="ruper-topcart dropdown">
                            <div class="dropdown mini-cart top-cart">
                                <div class="remove-cart-shadow"></div>
                                <a class="dropdown-toggle cart-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="icons-cart"><i class="icon-large-paper-bag"></i><span class="cart-count">2</span></div>
                                </a>
                                <div class="dropdown-menu cart-popup">
                                    <div class="cart-empty-wrap">
                                        <ul class="cart-list">
                                            <li class="empty">
                                                <span>No products in the cart.</span>
                                                <a class="go-shop" href="shop-grid-left.html">GO TO SHOP<i aria-hidden="true" class="arrow_right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-list-wrap">
                                        <ul class="cart-list ">
                                            <li class="mini-cart-item">
                                                <a href="#" class="remove" title="Remove this item"><i class="icon_close"></i></a>
                                                <a href="shop-details.html" class="product-image"><img width="600" height="600" src="media/product/3.jpg" alt=""></a>
                                                <a href="shop-details.html" class="product-name">Chair Oak Matt Lacquered</a>
                                                <div class="quantity">Qty: 1</div>
                                                <div class="price">$150.00</div>
                                            </li>
                                            <li class="mini-cart-item">
                                                <a href="#" class="remove" title="Remove this item"><i class="icon_close"></i></a>
                                                <a href="shop-details.html" class="product-image"><img width="600" height="600" src="media/product/1.jpg" alt=""></a>
                                                <a href="shop-details.html" class="product-name">Zunkel Schwarz</a>
                                                <div class="quantity">Qty: 1</div>
                                                <div class="price">$100.00</div>
                                            </li>
                                        </ul>
                                        <div class="total-cart">
                                            <div class="title-total">Total: </div>
                                            <div class="total-price"><span>$100.00</span></div>
                                        </div>
                                        <div class="free-ship">
                                            <div class="title-ship">Buy <strong>$400</strong> more to enjoy <strong>FREE Shipping</strong></div>
                                            <div class="total-percent">
                                                <div class="percent" style="width:20%"></div>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <a href="shop-cart.html" class="button btn view-cart btn-primary">View cart</a>
                                            <a href="shop-checkout.html" class="button btn checkout btn-default">Check out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-mobile-fixed">
            <!-- Shop -->
            <div class="shop-page">
                <a href="shop-grid-left.html"><i class="wpb-icon-shop"></i></a>
            </div>

            <!-- Login -->
            <div class="my-account">
                <div class="login-header">
                    <a href="page-my-account.html"><i class="wpb-icon-user"></i></a>
                </div>
            </div>

            <!-- Search -->
            <div class="search-box">
                <div class="search-toggle"><i class="wpb-icon-magnifying-glass"></i></div>
            </div>

            <!-- Wishlist -->
            <div class="wishlist-box">
                <a href="shop-wishlist.html"><i class="wpb-icon-heart"></i></a>
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
                                    <div class="search-toggle"><i class="icon-search"></i></div>
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
                                    <a class="active-login" href="#"><i class="icon-user"></i></a>
                                    <div class="form-login-register">
                                        <div class="box-form-login">
                                            <div class="active-login"></div>
                                            <div class="box-content">
                                                <div class="form-login active">
                                                    <form id="login_ajax" method="post" class="login">
                                                        <h2>Sign in</h2>
                                                        <p class="status"></p>
                                                        <div class="content">
                                                            <div class="username">
                                                                <input type="text" required="required" class="input-text" name="username" id="username" placeholder="Your name" />
                                                            </div>
                                                            <div class="password">
                                                                <input class="input-text" required="required" type="password" name="password" id="password" placeholder="Password" />
                                                            </div>
                                                            <div class="rememberme-lost">
                                                                <div class="rememberme">
                                                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                                                                    <label for="rememberme" class="inline">Remember me</label>
                                                                </div>
                                                                <div class="lost_password">
                                                                    <a href="forgot-password.html">Lost your password?</a>
                                                                </div>
                                                            </div>
                                                            <div class="button-login">
                                                                <input type="submit" class="button" name="login" value="Login" />
                                                            </div>
                                                            <div class="button-next-reregister">Create An Account</div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="form-register">
                                                    <form method="post" class="register">
                                                        <h2>REGISTER</h2>
                                                        <div class="content">
                                                            <div class="email">
                                                                <input type="email" class="input-text" placeholder="Email" name="email" id="reg_email" value="" />
                                                            </div>
                                                            <div class="password">
                                                                <input type="password" class="input-text" placeholder="Password" name="password" id="reg_password" />
                                                            </div>
                                                            <div class="button-register">
                                                                <input type="submit" class="button" name="register" value="Register" />
                                                            </div>
                                                            <div class="button-next-login">Already has an account</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Wishlist -->
                                <div class="wishlist-box">
                                    <a href="shop-wishlist.html"><i class="icon-heart"></i></a>
                                    <span class="count-wishlist">1</span>
                                </div>

                                <!-- Cart -->
                                <div class="ruper-topcart dropdown light">
                                    <div class="dropdown mini-cart top-cart">
                                        <div class="remove-cart-shadow"></div>
                                        <a class="dropdown-toggle cart-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="icons-cart"><i class="icon-large-paper-bag"></i><span class="cart-count">2</span></div>
                                        </a>
                                        <div class="dropdown-menu cart-popup">
                                            <div class="cart-empty-wrap">
                                                <ul class="cart-list">
                                                    <li class="empty">
                                                        <span>No products in the cart.</span>
                                                        <a class="go-shop" href="shop-grid-left.html">GO TO SHOP<i aria-hidden="true" class="arrow_right"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="cart-list-wrap">
                                                <ul class="cart-list ">
                                                    <li class="mini-cart-item">
                                                        <a href="#" class="remove" title="Remove this item"><i class="icon_close"></i></a>
                                                        <a href="shop-details.html" class="product-image"><img width="600" height="600" src="media/product/3.jpg" alt=""></a>
                                                        <a href="shop-details.html" class="product-name">Chair Oak Matt Lacquered</a>
                                                        <div class="quantity">Qty: 1</div>
                                                        <div class="price">$150.00</div>
                                                    </li>
                                                    <li class="mini-cart-item">
                                                        <a href="#" class="remove" title="Remove this item"><i class="icon_close"></i></a>
                                                        <a href="shop-details.html" class="product-image"><img width="600" height="600" src="media/product/1.jpg" alt=""></a>
                                                        <a href="shop-details.html" class="product-name">Zunkel Schwarz</a>
                                                        <div class="quantity">Qty: 1</div>
                                                        <div class="price">$100.00</div>
                                                    </li>
                                                </ul>
                                                <div class="total-cart">
                                                    <div class="title-total">Total: </div>
                                                    <div class="total-price"><span>$100.00</span></div>
                                                </div>
                                                <div class="free-ship">
                                                    <div class="title-ship">Buy <strong>$400</strong> more to enjoy <strong>FREE Shipping</strong></div>
                                                    <div class="total-percent">
                                                        <div class="percent" style="width:20%"></div>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <a href="shop-cart.html" class="button btn view-cart btn-primary">View cart</a>
                                                    <a href="shop-checkout.html" class="button btn checkout btn-default">Check out</a>
                                                </div>
                                            </div>
                                        </div>
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
                                            <a href="shop-grid-left.html"><span class="menu-item-text">Categories</span></a>

                                            <ul class="sub-menu">
                                                @foreach($categories as $category)
                                                @if( $category->sub_category->isNotEmpty())
                                                <li class="level-1 menu-item menu-item-has-children">
                                                    <a href="{{route('subcategory',[$category->id,$category->category])}}"><span class="menu-item-text text-capitalize">{{$category->category}}</span></a>
                                                    @foreach($category->sub_category as $subcategory)
                                                    <ul class="sub-menu">
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