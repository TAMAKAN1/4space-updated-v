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
                    <div class="col-12 col-md my-1 my-md-0 text-center text-md-start font-weight-600">Wishlist Products..</div>
                </div>

                <div class=" products-list grid row">
                    @if($wishlists->isNotEmpty())
                    @foreach($wishlists as $wishlist)
                    <div class="col-md-4">

                        <div class="item-product ">
                            <div class="items">
                                <div class="products-entry clearfix product-wapper">
                                    <div class="products-thumb">
                                        <div class="product-thumb-hover">
                                            <a href="{{route('product.details',[$wishlist->product->id,$wishlist->product->title])}}">
                                                @if($wishlist->product->images)
                                                <img width="600" height="600" src="{{$wishlist->product->images[0]->file}}" class="post-image" alt="">
                                                @if($wishlist->product->images[1])
                                                <img width="600" height="600" src="{{$wishlist->product->images[1]->file}}" class="hover-image back" alt="">
                                                @else
                                                <img width="600" height="600" src="{{$wishlist->product->images[0]->file}}" class="hover-image back" alt="">
                                                @endif
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-button">
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
                                            <a href="mailto:sales@4space.com.sa">Contact us <i class="ti-email  text-dark"></i></a>

                                            @endif

                                            <form action="{{route('delete.wishlist',$wishlist->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="background: none;border:none" class="btn-link bg-danger " title="Remove To Wishlist"><i class="fa fa-trash text-white"></i></button>
                                            </form>

                                        </div>

                                    </div>
                                    <div class="products-content">
                                        <div class="contents text-center">
                                            <h3 class="product-title"><a href="{{route('product.details',[$wishlist->product->id,$wishlist->product->title])}}">{{$wishlist->product->title}}</a></h3>
                                            <span class="price">{{$wishlist->product->price}} SAR</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                Not Add Yet!
                            </div>
                        </div>
                    </div>
                    @endif

                </div>


            </div>
            <!-- end right panel section -->

        </div>
    </div>
</section>
@endsection