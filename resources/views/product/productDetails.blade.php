<?php

use App\Category;
use App\Product;
use App\ReviewDetails;

$reviews = ReviewDetails::where('product_id', $product->id)->get();
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
                                <span class="text-warning">
                                    @for($i=1;$i<$reviews->avg('star');$i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </span>
                                <div class="review-count">
                                    ({{$reviews->count()}}<span> reviews</span>)
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
                                    @if($product->status=="in stock")

                                    <?php

                                    $find = Cart::get($product->id);

                                    ?>
                                    @if($find)
                                    <a href="{{route('cart')}}" class="btn btn-dark text-white btn-sm">View cart</a>
                                    @else
                                    <form action="{{route('store.cart',$product->id)}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><strong>Lets Buy....</strong></p>
                                            </div>
                                            <div class="col-5 col-md-4">
                                                <label>Width:</label>

                                                <select class="mb-4 form-control medium form-select" name="width">
                                                    <?php


                                                    $width = explode(",", $product->width);

                                                    ?>
                                                    <option value="">Choose one</option>

                                                    @foreach( $width as $wid)
                                                    <option value="{{$wid}}">{{$wid}}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                            <div class="col-5 col-md-4">
                                                <label>Height:</label>

                                                <select class="mb-4 form-control medium form-select" name="height">
                                                    <option value="">Choose one</option>

                                                    <?php
                                                    $heights = explode(",", $product->height);

                                                    ?>
                                                    @foreach( $heights as $height)


                                                    <option value="{{$height}}">{{$height}}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                            <div class="col-5 col-md-4">
                                                <div class="product-color">
                                                    <label>Color:</label>
                                                    <select class="mb-4 form-control medium form-select" name="color">
                                                        <option value="">Choose one</option>
                                                        <?php
                                                        $colors = explode(",", $product->color);

                                                        ?>
                                                        @foreach($colors as $color)
                                                        <option value="{{$color}}">{{$color}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">

                                            <div class="col-5 col-md-4">
                                                <div class="product-color">
                                                    <label>Size:</label>
                                                    <select class="mb-4 form-control medium form-select" name="size">
                                                        <option value="">Choose one</option>
                                                        <?php
                                                        $sizes = explode(",", $product->size);

                                                        ?>
                                                        @foreach($sizes as $size)
                                                        <option value="{{$size}}">{{$size}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <label>Qty:</label>
                                                <input type="number" name="quantity" value="1" min="1" placeholder="1" class="form-control medium " required>
                                            </div>
                                            @if($product->custom_status=="Yes")
                                            <div class="col-md-6  mt-4 ">
                                                <label for="customization">Have Customization?</label>
                                                <input type="checkbox" id="customization" name="customization" value="Yes">
                                                <br>
                                                <small><strong>Note*:</strong> Customization effect on pricing..</small>
                                            </div>
                                            <div class="col-md-12  mt-4" id="customcontent">
                                                <label for="">Leave A Note Here:</label>
                                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <div class="col-md-12 mt-4 ">
                                                    <button class="btn btn-dark text-white me-3 mb-2 mb-md-0"><span><i class="fa fa-shopping-cart me-1"></i> Add to Cart</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                    @else
                                    <span class="badge bg-danger"> Out of the stock</span> <br>
                                    <small> <a href="mailto:info@4space.com.sa">Contact us <i class="ti-email  text-dark"></i></a></small>

                                    @endif
                                    <form action="{{route('store.wishlist')}}" method="post" class="ml-4">
                                        @csrf
                                        @if(Auth::user())
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                        @endif
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        @if(Auth::user())

                                        <?php
                                        $wishlists = App\Wishlisht::where('product_id', $product->id)->where('user_id', auth()->user()->id)->first();
                                        ?>

                                        @if($wishlists)
                                        <a href="{{route('wishlists')}}" type="submit" style="border: none; background:none"><i class="fa fa-heart text-danger fill-danger"></i></a>
                                        @else
                                        <button type="submit" style="border: none; background:none" class=""><i class="fa fa-heart"></i></button>
                                        @endif
                                        @else
                                        <button type="submit" style="border: none; background:none"><i class="fa fa-heart"></i></button>
                                        @endif
                                    </form>
                                </div>
                                <br>


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
                                <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{$reviews->count()}})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                {!!$product->product_details!!}
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div id="reviews" class="product-reviews">

                                    @if($reviews->isNotEmpty())
                                    @foreach($reviews as $review)
                                    <div class="col-lg-8 offset-md-2 order-lg-2 mb-1-9 mb-lg-0">
                                        <div class="common-block">

                                            <div class="mb-2-3 pb-2-3 border-bottom">

                                                <div class="media mb-4 product-review">
                                                    <div class="media-body">
                                                        <a href="#" class="mb-1 font-weight-600 text-dark text-capitalize">{{$review->user->name}}</a>
                                                        <span class="d-block text-primary">{{date('d F Y', strtotime($review->created_at))}}</span>
                                                    </div>

                                                    <span class="text-warning">
                                                        @for($i=1;$i<$review->star;$i++)
                                                            <i class="fa fa-star"></i>
                                                            @endfor
                                                    </span>

                                                </div>

                                                <p class="mb-0 text-capitalize"> <strong>Comment: </strong> <br>{{$review->comment}}</p>

                                            </div>



                                        </div>

                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-8 offset-md-2 order-lg-2 mb-1-9 mb-lg-0">
                                        <div class="alert alert-danger">
                                            Not Review Add Yet!
                                        </div>
                                    </div>
                                    @endif
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
                                                        <div class="product-button">
                                                            @if($r_product->status=="in stock")
                                                            <?php
                                                            $find = Cart::get($r_product->id);
                                                            ?>
                                                            @if( $find)
                                                            <a href="{{route('cart')}}" class="btn btn-dark text-white btn-sm">View cart</a>
                                                            @else
                                                            <form action="{{route('store.cart',$r_product->id)}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="quantity" min="1" value="1">
                                                                <button type="submit" class="btn btn-dark text-white btn-sm">+ Add to cart</button>
                                                            </form>
                                                            @endif
                                                            @else
                                                            <span class="badge bg-danger"> Out of the stock</span> <br>
                                                            <small> <a href="">Contact us <i class="fa fa-email  text-dark"></i></a></small>

                                                            @endif

                                                            <form action="{{route('store.wishlist')}}" method="post">
                                                                @csrf
                                                                @if(Auth::user())
                                                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                                @endif
                                                                <input type="hidden" name="product_id" value="{{$r_product->id}}">
                                                                @if(Auth::user())

                                                                <?php
                                                                $wishlists = App\Wishlisht::where('product_id', $r_product->id)->where('user_id', auth()->user()->id)->first();
                                                                ?>

                                                                @if($wishlists)
                                                                <a href="{{route('wishlists')}}" type="submit" style="border: none; background:none"><i class="fa fa-heart text-danger fill-danger"></i></a>
                                                                @else
                                                                <button type="submit" style="border: none; background:none"><i class="fa fa-heart"></i></button>
                                                                @endif
                                                                @else
                                                                <button type="submit" style="border: none; background:none"><i class="fa fa-heart"></i></button>

                                                                @endif

                                                            </form>
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
@section('script')
<script>
    $(document).ready(function() {
        $("#customcontent").hide();
        $('#customization').click(function() {

            $("#customcontent").toggle();
        });
    });
</script>
@endsection