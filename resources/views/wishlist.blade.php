@extends('layouts.frontend.app')
@section('content')

<section class="md">
    <div class="container">
        <div class="row">

            <!-- sidebar panel -->

            <!-- end sidebar panel -->

            <!-- right panel section -->
            <div class="col-lg-12 col-12 ps-lg-1-9 order-1 order-lg-2 mb-1-9 mb-lg-0">

                <div class="row g-0 align-items-center bg-light rounded p-3 mb-1-9">
                    <div class="col-12 col-md my-1 my-md-0 text-center text-md-start font-weight-600">Wislist Products..</div>
                </div>

                <div class="row justify-content-center">
                    @if($wishlists->isNotEmpty())
                    @foreach($wishlists as $wishlist)
                    <div class="col-11 col-sm-6 col-xl-4 mb-1-9">
                        <div class="product-grid">
                            @if($wishlist->product->images)
                            <div class="product-img">
                                <a href="{{route('product.details',[$wishlist->product->id,$wishlist->product->title])}}">
                                    <img src="{{asset($wishlist->product->images[0]->file)}}" alt="...">
                                </a>
                            </div>
                            @endif
                            <div class="product-description">
                                <h3><a href="{{route('product.details',[$wishlist->product->id,$wishlist->product->title])}}">{{$wishlist->product->title}}</a></h3>
                                <h4 class="price">
                                    <span class="offer-price">{{$wishlist->product->price}} SAR</span>
                                </h4>
                            </div>
                            <div class="product-buttons">
                                <ul class="ps-0">
                                    <li>
                                        <form action="{{route('delete.wishlist',$wishlist->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="background: none;border:none" class="btn-link bg-danger " title="Remove To Wishlist"><i class="fa fa-trash text-white"></i></button>
                                        </form>

                                    </li>
                                    <li>
                                        @if($wishlist->product->status=="in stock")
                                        <?php
                                        $find = Cart::get($wishlist->product->id);

                                        ?>
                                        @if( $find)
                                        <a href="{{route('cart')}}" class="btn btn-dark text-white btn-sm">View cart</a>
                                        @else
                                        <form action="{{route('store.cart',$wishlist->product->id)}}" method="post">
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