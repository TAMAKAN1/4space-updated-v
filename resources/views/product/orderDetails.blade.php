<?php


if (auth()->user()->type == "Admin") {
    $layouts = "layouts.backend.app";
} else {
    $layouts = "layouts.frontend.app";
}
if ($order->order_status == "order confirmed") {
    $a = "active";
    $b = "";
    $c = "";
    $d = "";
} elseif ($order->order_status == "payment confirmed") {
    $a = "active";
    $b = "active";
    $c = "";
    $d = "";
} elseif ($order->order_status == "on the process") {
    $a = "active";
    $b = "active";
    $c = "active";
    $d = "";
} else if ($order->order_status == "ready to pickup") {
    $a = "active";
    $b = "active";
    $c = "active";
    $d = "active";
} else if ($order->order_status == "delivered") {
    $a = "active";
    $b = "active";
    $c = "active";
    $d = "active";
} else {
    $a = "";
    $b = "";
    $c = "";
    $d = "";
}
?>



@extends($layouts)
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

    body {
        background-color: #eeeeee;
        font-family: 'Open Sans', serif
    }

    .container {
        margin-top: 50px;
        margin-bottom: 50px
    }

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 135px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #FF5722
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #ee5435;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
</style>
<div class="container-fluid mt-4 mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <article class="card">
                    <header class="card-header"> <strong>Order Details / Tracking view</strong> </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Order ID: <span class="badge bg-info"><strong>{{$order->invoice}}</strong></span></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4 class="text-right"> <strong>Total Price: {{$order->total}} SAR</strong></h4>
                            </div>
                        </div>
                        <article class="card">

                            <div class="card-body row">
                                <div class="col">
                                    <p><strong class="">Customer Information:</strong> </p>
                                    <p class="text-capitalize"><i class="fa fa-user"></i> {{$order->user->name}}</p>
                                    <p><i class="ti-email  text-dark"></i> {{$order->user->email}}</p>
                                    <p><i class="ti-mobile  text-dark"></i> {{$order->user->phone}}</p>
                                </div>

                                <div class="col">
                                    <p> <strong>Shipping Address:</strong></p>
                                    <p class="text-capitalize">
                                        <i class="fa fa-home"></i> {{$order->shipping->full_address}}
                                    </p>
                                    <p class="text-capitalize">
                                        <i class="fa fa-building"></i> {{$order->shipping->city}}
                                    </p>
                                    <p class="text-capitalize">
                                        <i class="fa fa-file-archive"></i> {{$order->shipping->zipcode}}
                                    </p>
                                    @if($order->shipping->link)
                                    <p class="text-capitalize">
                                        <i class="fa fa-location"></i> <a target="_blank" href="{{$order->shipping->link}}"> Attached Location </a>
                                    </p>
                                    @endif
                                </div>
                                @if($order->note)
                                <div class="col">
                                    <p>
                                        <strong>Order Note: </strong> <br>
                                    </p>
                                    <p>{{$order->note}}</p>
                                </div>
                                @endif
                                <div class="col"> <strong>Status </strong> <br> <span class="badge bg-success">{{$order->order_status}}</span>
                                    @if($order->review)
                                    <div class="col-md-12 mt-4">
                                        <p><strong>Reviewed:</strong> </p>
                                        <span class="text-warning">
                                            @for($i=1;$i<$order->review->star;$i++)
                                                <i class="fas fa-star"></i>
                                                @endfor
                                        </span>
                                        <p><strong>comment:</strong> {{$order->review->comment}}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                        <div class="track">
                            <div class="step {{$a}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text"><small>Order confirmed</small></span> </div>
                            <div class="step {{$b}}"> <span class="icon"> <i class="fa fa-credit-card"></i> </span> <span class="text"><small>Payment Confirmed</small></span> </div>
                            <div class="step {{$c}}"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> <small>On the way</small> </span> </div>
                            <div class="step {{$d}}"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><small>Ready for pickup</small></span> </div>
                        </div>
                        <hr>
                        <ul class="row mt-4">
                            @foreach($order->order_details as $od)
                            <li class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside">
                                        @if($od->product->images)
                                        <img src="{{asset($od->product->images[0]->file)}}" class="img-sm border">
                                        @endif
                                    </div>
                                    <figcaption class="info align-self-center">
                                        <p class="title text-capitalize"><a href=""><strong>{{$od->product->title}}</strong></a> <br>
                                            <strong>Quantity </strong>: {{$od->quantity}}
                                        </p>
                                        <span class="text-muted"><strong>Sub Total: </strong> {{$od->subtotal}} SAR </span> <br>
                                        @if($od->color)
                                        <span class="text-muted"><strong>Color: </strong> {{$od->color}} </span>
                                        @endif
                                        <br>
                                        @if($od->width)
                                        <span class="text-muted"><strong>Width: </strong> {{$od->width}} </span>
                                        @endif
                                        <br>
                                        @if($od->height)
                                        <span class="text-muted"><strong>Height: </strong> {{$od->height}} </span>
                                        @endif
                                        <br>

                                        @if($od->size)
                                        <span class="text-muted"><strong>Size: </strong> {{$od->size}} </span>
                                        @endif
                                        <br>
                                        @if($od->description)
                                        <span class="text-muted"><strong>Description: </strong> {{$od->description}} </span>
                                        @endif
                                    </figcaption>
                                </figure>
                            </li>
                            @endforeach
                        </ul>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 text-right">
                                <a href="/home" class="btn btn-warning m-2" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>

                            </div>
                            <div class="col-md-6">
                                @if($order->order_status=="pending" && auth()->user()->type!="Admin")
                                <a class="btn btn-danger text-white m-2" data-abc="true"data-toggle="modal" data-target="#exampleModalCenter{{$order->id}}"> <i class="fa fa-sign-out"></i> Cancel Order</a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Want to cancel order?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                                <form action="{{route('cancel.customer.order',$order->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="customer_order_status" value="Cancel by Customer side">
                                                    <button type="submit" class="btn btn-success text-white m-2" data-abc="true"> <i class="fa fa-sign-out"></i>Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection