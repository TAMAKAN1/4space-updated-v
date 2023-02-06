@extends('layouts.frontend.app')
@section('content')
<section class="py-0 mt-4 mb-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 ps-2-3 mb-1-9 mb-lg-0">

                <div class="common-block">

                    <div class="inner-title card-header p-2 text-center">
                        <h4 class="mb-0"><strong>Review Your Order</strong></h4>
                    </div>

                    <div class="shop-cart-table">
                        <table class="table border shop-cart text-center table-responsive">
                            <colgroup>
                                <col width="100">
                                <col>
                                <col width="1">
                                <col>
                                <col width="100">
                                <col width="1">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th class="first"></th>
                                    <th class="text-start text-uppercase font-weight-500">Product</th>
                                    <th class="text-start text-uppercase font-weight-500">Price</th>
                                    <th class="text-center text-uppercase font-weight-500">Qty</th>
                                    <th class="text-start text-uppercase font-weight-500">Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($products) && !$products->isEmpty())
                                @foreach($products as $product)
                                <tr>
                                    <td class="product-thumbnail text-start">
                                        @if($product->images)
                                        <a href="{{route('product.details',[$product->id,$product->title])}}"><img src="{{asset($product->images[0]->file)}}" alt="..."></a>
                                        @endif
                                    </td>
                                    <td class="text-start">
                                        <a href="{{route('product.details',[$product->id,$product->title])}}" class="text-capitalize"><strong>{{$product->title}}</strong></a>
                                        <span class="text-uppercase d-block">SKU: {{$product->SKU}}</span>
                                        @if($product->width)
                                        <span class="text-capitalize d-block">Width: {{$product->width}}</span>
                                        @endif
                                        @if($product->height)
                                        <span class="text-capitalize d-block">height: {{$product->height}}</span>
                                        @endif
                                        @if($product->color)
                                        <span class="text-capitalize d-block">Color: {{$product->color}}</span>
                                        @endif
                                        @if($product->size)
                                        <span class="text-capitalize d-block">Size: {{$product->size}}</span>
                                        @endif
                                        @if($product->description)
                                        <span class="text-capitalize d-block">Description: {{$product->description}}</span>
                                        @endif
                                        @if($product->custom_status=="Yes")
                                        <p><small><strong>Note:</strong> if you have customization, then price will be effect.</small></p>
                                        @endif
                                    </td>
                                    <td class="text-start">
                                        {{$product->price}} SAR
                                    </td>
                                    <td class="product-quantity">
                                        <form action="{{route('update.cart',$product->id)}}" method="post">
                                            @csrf
                                            @method('patch')
                                            <div class="row ">

                                                <div class="col-md-6 text-right">
                                                    <input type="number" name="quantity" min="1" class="form-control " value="{{$product->quantity}}">
                                                </div>
                                                <div class="col-md-6 mt-1 text-left">
                                                    <button type="submit" class="btn btn-dark text-white"><i class="fa fa-refresh"></i></button>
                                                </div>
                                            </div>

                                        </form>

                                    </td>
                                    <td class="product-subtotal text-start">{{$product->price*$product->quantity}} SAR</td>
                                    <td class="product-remove text-center">
                                        <?php

                                        ?>
                                        <form action="{{route('destroyCart',$product->id)}}" method="post">
                                            @csrf
                                            @method('Delete')
                                            <button type="submit" class="btn btn-danger text-white btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <div class="alert alert-danger text-center">
                                    <p>Product Not Add Yet!</p>
                                    <p>
                                        <a href="{{route('all.products')}}" class="btn btn-dark text-white"><span>Continue Shopping</span></a>

                                    </p>
                                </div>

                                @endif
                            </tbody>
                        </table>
                    </div>



                </div>

            </div>
            <div class="col-lg-6 col-12 side-bar">
                <form method="post" action="{{route('store.order')}}">
                    @csrf
                    <div class="col-md-12">
                        <div class="col-lg-12 col-12 pe-lg-2-3 mb-1-9 mb-lg-0">

                            <div class="common-block">

                                <div class="inner-title">
                                    <h4 class="mb-0">Billing Address</h4>
                                </div>


                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label> Name*</label>
                                            <input type="text" class="form-control" name="name" placeholder="Your name here" value="{{auth()->user()->name}}" required>
                                        </div>

                                    </div>


                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label>Email Address*</label>
                                            <input type="email" class="form-control" name="email" placeholder="Your email address here" value="{{auth()->user()->email}}" required>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="number" class="form-control" name="phone" placeholder="Your phone number here" value="{{auth()->user()->phone}}" required>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label>Full Address* </label>
                                            <input type="text" class="form-control" name="full_address" placeholder="Your address here" required>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label>City / Town* </label>
                                            <input type="text" class="form-control" name="city" placeholder="Your city name here" required>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label>Zip Code*</label>
                                            <input type="text" class="form-control" name="zipcode" placeholder="Your zip code here" required>
                                        </div>

                                    </div>
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label>Google Location Link(optional)</label>
                                            <input type="text" class="form-control" name="link" placeholder="Your Map Location link">
                                        </div>

                                    </div>
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label>Order Note(optional): </label>
                                            <textarea id="" cols="20" rows="8" class="form-control" name="note" placeholder="Note."></textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="widget text-right">
                        <table class="table">
                            <tbody class=" p-4 ">
                                <tr class="p-4">
                                    <th class="text-start pe-0 text-uppercase "> Subtotal</th>
                                    <td class="text-uppercase text-start pe-0"><strong>{{ $cart['subTotal'] }}</strong> SAR</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mb-4 widget text-right">
                        <small><strong>Note:</strong>Total Price will be Change depend on customization and Shipping area*. </small>
                    </div>
                    @if($cart['subTotal'] !=0)

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-dark text-white wide">Place Order <i class="fa fa-arrow-right ms-1"></i></button>
                    </div>
                    @endif
                </form>

            </div>

        </div>
    </div>
</section>
@endsection