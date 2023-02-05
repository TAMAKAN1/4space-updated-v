<?php

use App\Category;
use App\Product;
use App\ReviewDetails;

$related_products = Product::where('category_id', $product->category->id)->where('id', '!=', $product->id)->orderBy('id', 'desc')->get();
?>
@extends('layouts.frontend.app')
@section('content')
<div id="content" class="site-content mt-4 mb-4" role="main">
    <div class="shop-details zoom" data-product_layout_thumb="scroll" data-zoom_scroll="true" data-zoom_contain_lens="true" data-zoomtype="inner" data-lenssize="200" data-lensshape="square" data-lensborder="" data-bordersize="2" data-bordercolour="#f9b61e" data-popup="false">
        <div class="product-top-info">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="row">
                        <div class="product-images col-lg-7 col-md-12 col-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="content-thumbnail-scroll">
                                        <div class="image-thumbnail slick-carousel slick-vertical" data-asnavfor=".image-additional" data-centermode="true" data-focusonselect="true" data-columns4="5" data-columns3="4" data-columns2="4" data-columns1="4" data-columns="4" data-nav="true" data-vertical="&quot;true&quot;" data-verticalswiping="&quot;true&quot;">
                                            @if($product->images)
                                            @foreach($product->images as $img)
                                            <div class="img-item slick-slide">
                                                <span class="img-thumbnail-scroll">
                                                    <img width="600" height="600" src="{{$img->file}}" alt="">
                                                </span>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="scroll-image main-image">
                                        <div class="image-additional slick-carousel" data-asnavfor=".image-thumbnail" data-fade="true" data-columns4="1" data-columns3="1" data-columns2="1" data-columns1="1" data-columns="1" data-nav="true">
                                            @if($product->images)
                                            @foreach($product->images as $img)
                                            <div class="img-item slick-slide">
                                                <img width="900" height="900" src="{{$img->file}}" alt="" title="">
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-info col-lg-5 col-md-12 col-12 ">
                            <h1 class="title">{{$product->title}}</h1>
                            <span class="price">
                                <ins><span>{{$product->price}} SAR</span></ins>
                            </span>
                            <div class="rating">
                                <div class="star star-5"></div>
                                <div class="review-count">
                                    (3<span> reviews</span>)
                                </div>
                            </div>
                            <div class="description">
                                <p>{!! Str::limit($product->product_details, 200, ' ...') !!}</p>
                            </div>
                            <div class="variations">
                                <table cellspacing="0">
                                    <tbody>
                                        <tr>
                                            @if($product->size)
                                            <td class="label">Size</td>
                                            <td class="attributes">
                                                <ul class="text">
                                                    <?php
                                                    $sizes = explode(',', $product->size); ?>
                                                    @foreach( $sizes as $size)
                                                    <li><span>{{$size}}</span></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            @if($product->size)
                                            <td class="label">Color</td>
                                            <td class="attributes">
                                                <ul class="color">
                                                    <?php
                                                    $colors = explode(',', $product->color); ?>
                                                    @foreach( $colors as $color)
                                                    <li><span class="btn btn-sm text-capitalize">{{$color}}</span></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            @endif
                                        </tr>


                                    </tbody>
                                </table>


                            </div>
                            <div class="row text-left">
                                <div class="col-md-6" style="border-right:1px solid #ccc">
                                    <p>Width</p>
                                    <div class="content">
                                        <?php
                                        $widths = explode(',', $product->width); ?>
                                        @foreach( $widths as $width)
                                        <p class="btn btn-sm text-capitalize">{{ $width}}</p> <br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>Height</p>
                                    <div class="content">
                                    <?php
                                        $heights = explode(',', $product->height); ?>
                                        @foreach( $heights as $height)
                                        <p class="btn btn-sm text-capitalize">{{ $height}}</p> <br>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="buttons">
                                <div class="add-to-cart-wrap">
                                    <div class="quantity">
                                        <button type="button" class="plus">+</button>
                                        <input type="number" class="qty" step="1" min="0" max="" name="quantity" value="1" title="Qty" size="4" placeholder="" inputmode="numeric" autocomplete="off">
                                        <button type="button" class="minus">-</button>
                                    </div>
                                    <div class="btn-add-to-cart">
                                        <a href="#" class="button" tabindex="0">Add to cart</a>
                                    </div>
                                </div>
                                <br>
                                <div class="btn-wishlist col-md-12">
                                    <button class="product-btn">Add to wishlist</button>
                                </div>

                            </div>
                            <div class="product-meta">
                                <span class="sku-wrapper">SKU: <span class="sku"><strong>{{$product->SKU}}</strong></span></span>
                                <span class="posted-in">Category: <a href="{{route('subcategory',[$product->category->id,$product->category->category])}}" rel="tag">
                                        {{$product->category->category}}
                                        @if($product->sub_category)
                                        <i class="fa fa-arrow-right">{{$product->sub_category->sub_category}}</i>
                                        @endif
                                        @if($product->sub_sub_category)
                                        <i class="fa fa-arrow-right">{{$product->sub_sub_category->sub_sub_category}}</i>
                                        @endif
                                    </a></span>

                            </div>
                            <div class="social-share">
                                <a href="#" title="Facebook" class="share-facebook" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                                <a href="#" title="Twitter" class="share-twitter"><i class="fa fa-twitter"></i>Twitter</a>
                                <a href="#" title="Pinterest" class="share-pinterest"><i class="fa fa-pinterest"></i>Pinterest</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tabs">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="product-tabs-wrap">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                {!!$product->product_details!!}
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div id="reviews" class="product-reviews">
                                    <div id="comments">
                                        <h2 class="reviews-title">1 review for <span>Bora
                                                Armchair</span></h2>
                                        <ol class="comment-list">
                                            <li class="review">
                                                <div class="content-comment-container">
                                                    <div class="comment-container">
                                                        <img src="media/user.jpg" class="avatar" height="60" width="60" alt="">
                                                        <div class="comment-text">
                                                            <div class="rating small">
                                                                <div class="star star-5"></div>
                                                            </div>
                                                            <div class="review-author">Peter Capidal
                                                            </div>
                                                            <div class="review-time">January 12,
                                                                2022</div>
                                                        </div>
                                                    </div>
                                                    <div class="description">
                                                        <p>good</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                    <div id="review-form">
                                        <div id="respond" class="comment-respond">
                                            <span id="reply-title" class="comment-reply-title">Add a
                                                review</span>
                                            <form action="#" method="post" id="comment-form" class="comment-form">
                                                <p class="comment-notes">
                                                    <span id="email-notes">Your email address will
                                                        not be published.</span> Required fields are
                                                    marked <span class="required">*</span>
                                                </p>
                                                <div class="comment-form-rating">
                                                    <label for="rating">Your rating</label>
                                                    <p class="stars">
                                                        <span>
                                                            <a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a>
                                                        </span>
                                                    </p>
                                                </div>
                                                <p class="comment-form-comment">
                                                    <textarea id="comment" name="comment" placeholder="Your Reviews *" cols="45" rows="8" aria-required="true" required=""></textarea>
                                                </p>
                                                <div class="content-info-reviews">
                                                    <p class="comment-form-author">
                                                        <input id="author" name="author" placeholder="Name *" type="text" value="" size="30" aria-required="true" required="">
                                                    </p>
                                                    <p class="comment-form-email">
                                                        <input id="email" name="email" placeholder="Email *" type="email" value="" size="30" aria-required="true" required="">
                                                    </p>
                                                    <p class="form-submit">
                                                        <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                                    </p>
                                                </div>
                                            </form><!-- #respond -->
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-related">
            <div class="section-padding">
                <div class="section-container p-l-r">
                    <div class="block block-products slider">
                        <div class="block-title">
                            <h2>Related Products</h2>
                        </div>
                        <div class="block-content">
                            <div class="content-product-list slick-wrap">
                                <div class="slick-sliders products-list grid" data-slidestoscroll="true" data-dots="false" data-nav="1" data-columns4="1" data-columns3="2" data-columns2="3" data-columns1="3" data-columns1440="4" data-columns="4">
                                    @if($related_products->isNotEmpty())
                                    @foreach($related_products as $r_product)
                                    <div class="item-product slick-slide">
                                        <div class="items">
                                            <div class="products-entry clearfix product-wapper">
                                                <div class="products-thumb">
                                                    @if($r_product->images->isNotEmpty())
                                                    <div class="product-thumb-hover">
                                                        <a href="{{route('product.details',[$r_product->id,$r_product->title])}}">

                                                            <img width="600" height="600" src="{{$r_product->images[0]->file}}" class="post-image" alt="">
                                                            @if($r_product->images[1]->file)
                                                            <img width="600" height="600" src="{{$r_product->images[1]->file}}" class="hover-image back" alt="">
                                                            @else
                                                            <img width="600" height="600" src="{{$r_product->images[0]->file}}" class="hover-image back" alt="">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    @endif
                                                    <div class="product-button">
                                                        <div class="btn-add-to-cart" data-title="Add to cart">
                                                            <a rel="nofollow" href="#" class="product-btn button">Add to
                                                                cart</a>
                                                        </div>
                                                        <div class="btn-wishlist" data-title="Wishlist">
                                                            <button class="product-btn">Add to
                                                                wishlist</button>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="products-content">
                                                    <div class="contents text-center">
                                                        <h3 class="product-title"><a href="{{route('product.details',[$r_product->id,$r_product->title])}}"><strong>{{$r_product->title}}</strong></a></h3>

                                                        <span class="price"><strong>{{$r_product->price}}</strong> SAR</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection