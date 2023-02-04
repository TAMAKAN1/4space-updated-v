@extends('layouts.frontend.app')
@section('content')
<section class="py-0">
    <div class="container">
        <div class="row mt-n4">
            <div class="col-12 shop-cart-table">
                <table class="table border shop-cart text-center">
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
                                    <button type="submit" class="btn btn-danger text-white btn-sm"><i class="fas fa-trash"></i></button>
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

            <div class="col-12 cart-total pt-1-9 pt-lg-2-3">
                <div class="row">

                    <div class="col-lg-5 col-md-5 mb-1-9 mb-md-0">

                    </div>
                    @if($cart['subTotal'] !=0)
                    <div class="col-lg-6 offset-lg-1 col-md-7 offset-md-0 ">
                        <table class="table cart-sub-total">
                            <tbody class="border p-4">
                                <tr class="p-4">
                                    <th class="text-end pe-0 text-uppercase">Cart Subtotal</th>
                                    <td class="text-uppercase text-end pe-0"><strong>{{ $cart['subTotal'] }}</strong> SAR</td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="butn-style2 float-end" href="{{route('checkout')}}"><span>Proceed to Checkout</span></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection