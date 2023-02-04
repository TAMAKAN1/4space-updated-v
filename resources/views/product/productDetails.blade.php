<?php

use App\Category;
use App\ReviewDetails;

?>
@extends('layouts.frontend.app')
@section('content')

<section class="md">
    <div class="container">

        <!-- product section -->
        <div class="row mb-6 mb-md-7 mb-lg-9">
            <div class="col-lg-5 text-center text-lg-start mb-1-9 mb-lg-0">
                @if($product->images)
                <!-- product left start -->
                <div class="xzoom-container">
                    <img class="xzoom5 mb-1-9" id="xzoom-magnific" src="{{asset($product->images[0]->file)}}" xoriginal="{{asset($product->images[0]->file)}}" alt="..." />
                    <div class="xzoom-thumbs no-margin">
                        @foreach($product->images as $image)

                        <a href="{{asset($image->file)}}"><img class="xzoom-gallery5" width="100" src="{{asset($image->file)}}" xpreview="{{asset($image->file)}}" title="{{$product->title}}"></a>


                        @endforeach
                    </div>
                </div>
                <!-- product left end -->
                @endif
            </div>
            <div class="col-lg-7 ps-lg-2-3">
                <div class="product-detail">
                    <!-- <span class="label-sale bg-primary text-white text-uppercase display-31">Sale</span> -->
                    <h2 class="mb-1 text-capitalize">{{$product->title}} </h2>
                    <p class="rating-text"><span>SKU:</span> <span class="font-500 theme-color">{{$product->SKU}}</span></p>
                    <p class="rating-text"><span>Fabric:</span> <span class="font-500 theme-color">{{$product->fabric}}</span></p>

                    <!-- <div class="mb-4">

                        <div class="d-inline-block me-3 pe-3 borders-end border-color-extra-medium-gray">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>

                    </div> -->
                    <div class="mb-4">
                        <!-- <span class="me-3 display-26 font-weight-600 offer-price">$21.00</span> -->
                        <span class="display-26 font-weight-700 text-primary">{{$product->price}} SAR</span>
                    </div>
                    <div class=" row mb-4">
                        <!-- <span class="me-3 display-26 font-weight-600 offer-price">$21.00</span> -->
                        <div class="card p-4">
                            <p><strong>Default Dimension</strong></p>
                            <p><strong>Width: </strong> {{$product->width}}</p>
                            <p><strong>Height: </strong> {{$product->height}}</p>
                            <p><strong>Color:</strong> {{$product->color}}</p>
                        </div>
                    </div>
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
                            <div class="col-5 col-md-3">
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
                            <div class="col-5 col-md-3">
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
                            <div class="col-5 col-md-3">
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
                            <div class="col-md-4 ">
                                <label>Qty:</label>
                                <input type="number" name="quantity" value="1" min="1" placeholder="1" class="form-control medium " required>
                            </div>
                            @if($product->custom_status=="Yes")
                            <div class="col-md-4  mt-4 ">
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
                            <div class="col-md-12 mt-4 ">
                                <button class="butn-style2 me-3 mb-2 mb-md-0"><span><i class="fas fa-shopping-cart me-1"></i> Add to Cart</span></button>
                            </div>
                        </div>
                    </form>
                    @endif
                    @else
                    <span class="badge bg-danger"> Out of the stock</span> <br>
                    <small> <a href="mailto:info@4space.com.sa">Contact us <i class="ti-email  text-dark"></i></a></small>

                    @endif
                    <div class="row mb-2">
                        <div class="col-md-12 mt-4 ">
                            @if($product->category)
                            <p>
                                <strong>Category:</strong>
                                <span class="text-capitalize">{{$product->category->category}}</span>
                                @if($product->sub_category)
                                <span class="text-capitalize"><i class="fa fa-arrow-right"></i>{{$product->sub_category->sub_category}}</span>

                                @endif
                                @if($product->sub_sub_category)
                                <span class="text-capitalize"><i class="fa fa-arrow-right"></i>{{$product->sub_sub_category->sub_sub_category}}</span>

                                @endif
                            </p>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- end product section -->

        <!-- product description -->
        <div class="row justify-content-center mb-6 mb-md-7">

            <div class="col-12">
                <div class="horizontaltab tab-style-two">
                    <ul class="resp-tabs-list hor_1 text-start">
                        <li><i class="ti-line-dashed d-md-block d-none"></i>Description</li>
                        <li><i class="ti-star d-md-block d-none text-warning"></i>Reviews </li>
                    </ul>
                    <div class="resp-tabs-container hor_1">
                        <div>

                            <p>{!!$product->product_details!!}</p>

                        </div>

                        <div>
                            <div class="row">
                                <?php
                                $reviews = ReviewDetails::where('product_id', $product->id)->get()
                                ?>
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
                                                        <i class="fas fa-star"></i>
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


                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end product description -->
        <?php
        $p_category = Category::where('id', $product->category->id)->first();
        $p_products = App\Product::where('category_id', $p_category->id)->where('id', '!=', $product->id)->orderBy('id', 'desc')->get();
        ?>
        @if($p_products)

        <!-- related product -->
        <div class="inner-title">
            <h3 class="mb-0">Related Products</h3>
        </div>

        <div class="product-grid-slide owl-carousel owl-theme">
            @foreach($p_products as $pproduct)
            <div class="product-grid">
                @if($pproduct->images)
                <div class="product-img">
                    <a href="{{route('product.details',[$pproduct->id,$pproduct->title])}}">
                        <img src="{{$pproduct->images[0]->file}}" alt="...">
                    </a>
                </div>
                @endif
                <div class="product-description">
                    <h3><a href="{{route('product.details',[$pproduct->id,$pproduct->title])}}">{{$pproduct->title}}</a></h3>
                    <h4 class="price">
                        <span class="regular-price">{{$pproduct->price}} SAR</span>
                    </h4>
                </div>
                <div class="product-buttons">
                    <ul class="ps-0">
                        <li>

                            <form action="{{route('store.wishlist')}}" method="post">
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
                                <a href="{{route('wishlists')}}" type="submit" style="border: none; background:none"><i class="ti-heart text-danger fill-danger"></i></a>
                                @else
                                <button type="submit" style="border: none; background:none"><i class="ti-heart"></i></button>
                                @endif
                                @else
                                <button type="submit" style="border: none; background:none"><i class="ti-heart"></i></button>

                                @endif

                            </form>

                            </i></a>
                        </li>
                        <li>
                            @if($product->status=="in stock")
                            <?php
                            $find = Cart::get($product->id);

                            ?>
                            @if( $find)
                            <a href="{{route('cart')}}" class="btn btn-dark text-white btn-sm">View cart</a>
                            @else
                            <form action="{{route('store.cart',$product->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="quantity" min="1" value="1">
                                <button type="submit" class="btn btn-dark text-white btn-sm">+ Add to cart</button>
                            </form>
                            @endif
                            @else
                            <span class="badge bg-danger"> Out of the stock</span> <br>
                            <small> <a href="">Contact us <i class="ti-email  text-dark"></i></a></small>

                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <!-- end related product -->

    </div>
</section>



</div>


<!-- SCROLL TO TOP
    ================================================== -->
<a href="#" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>

<!-- all js include start -->

<!-- jQuery -->
<script src="{{asset('js/jquery.min.js')}}"></script>

<!-- zoom js -->
<script src="{{asset('js/xzoom.js')}}"></script>

<!-- hammer js -->
<script src="{{asset('js/jquery.hammer.min.js')}}"></script>

<!-- setup js -->
<script src="{{asset('js/setup.js')}}"></script>

<!-- custom scripts -->
<script src="{{asset('js/main.js')}}"></script>

<!-- all js include end -->


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