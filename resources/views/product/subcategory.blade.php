@extends('layouts.frontend.app')
@section('content')


<div id="site-main" class="site-main mt-4 mb-4">
    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">

            <div id="content" class="site-content" role="main">
                <div class="col-md-12 text-right mt-2 mt-4">
                    <form class="form-inline" method="get" action="{{route('search.product')}}">
                        @csrf
                        <div class="col-md-12">

                            <input class="form-control mr-sm-2" type="search" placeholder="Search Here" aria-label="Search" name="name">
                            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="section-padding">
                    <div class="section-container p-l-r">
                        <div class="row">
                            @include('product.productside')

                            <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="layout-grid" role="tabpanel">
                                        <div class="products-list grid">
                                            <div class="row">
                                                @if($sub_category->product->isNotEmpty())
                                                @foreach($sub_category->product as $product)
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                                    <div class="products-entry clearfix product-wapper">
                                                        <div class="products-thumb">

                                                            <div class="product-thumb-hover">
                                                                @if($product->images)
                                                                <a href="{{route('product.details',[$product->id,$product->title])}}">
                                                                    <img width="600" height="600" src="{{$product->images[0]->file}}" class="post-image" alt="">
                                                                    @if($product->images[1])
                                                                    <img width="600" height="600" src="{{$product->images[1]->file}}" class="hover-image back" alt="">
                                                                    @else
                                                                    <img width="600" height="600" src="{{$product->images[0]->file}}" class="post-image" alt="">
                                                                    @endif
                                                                </a>
                                                                @endif
                                                            </div>
                                                            <div class="product-button">
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
                                                                <a href="mailto:sales@4space.com.sa">Contact us <i class="ti-email  text-dark"></i></a>

                                                                @endif

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
                                                                    <a href="{{route('wishlists')}}" type="submit" style="border: none; background:none"><i class="fa fa-heart text-danger fill-danger"></i></a>
                                                                    @else
                                                                    <button type="submit" style="border: none; background:none" class=""><i class="fa fa-heart"></i></button>
                                                                    @endif
                                                                    @else
                                                                    <button type="submit" style="border: none; background:none"><i class="fa fa-heart"></i></button>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="products-content">
                                                            <div class="contents text-center">
                                                                <h3 class="product-title"><a href="{{route('product.details',[$product->id,$product->title])}}"> <strong>{{$product->title}}</strong></a></h3>
                                                                <span class="price"><strong>{{$product->price}} SAR</strong></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="alert alert-danger text-center col-md-12 mt-4">
                                                    <p>Product Not add Yet!</p>
                                                </div>
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
            <!-- end right panel section -->
        </div>
    </div>
</div>

@endsection