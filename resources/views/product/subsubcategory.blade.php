@extends('layouts.frontend.app')
@section('content')

<section class="md">
    <div class="container-fluid">
        <div class="row">

            <!-- sidebar panel -->
            @include('product.productside')

            <!-- end sidebar panel -->

            <!-- right panel section -->
            <div class="col-lg-9 col-12 ps-lg-1-9 order-1 order-lg-2 mb-1-9 mb-lg-0">

                <div class="row g-0 align-items-center bg-light rounded p-3 mb-1-9">
                    <div class="col-12 col-md my-1 my-md-0 text-center text-md-start font-weight-600">Latest Products..</div>
                </div>

                <div class="row justify-content-center">
                    @if($products->isNotEmpty())
                    @foreach($products as $product)
                    <div class="col-11 col-sm-6 col-xl-4 mb-1-9">
                        <div class="product-grid">
                            @if($product->images)
                            <div class="product-img">
                                <a href="{{route('product.details',[$product->id,$product->title])}}">
                                    <img src="{{asset($product->images[0]->file)}}" alt="...">
                                </a>
                            </div>
                            @endif
                            <div class="product-description">
                                <h3><a href="{{route('product.details',[$product->id,$product->title])}}">{{$product->title}}</a></h3>
                                <h4 class="price">
                                    <span class="offer-price">{{$product->price}} SAR</span>
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
                                        <a href="mailto:info@4space.com.sa">Contact us <i class="ti-email  text-dark"></i></a>

                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-danger">
                        <p>Product Not Add Yet!</p>
                    </div>
                    @endif
                </div>


            </div>
            <!-- end right panel section -->

        </div>
    </div>
</section>
@endsection