<?php

use App\Order;

if (auth()->user()->type == "Admin") {
    $layouts = "layouts.backend.app";
    $orders = Order::orderBy('id', 'desc')->get();
} else {
    $layouts = "layouts.frontend.app";
    $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
}
?>
@extends($layouts)
@section('content')
@if(auth()->user()->type=="Admin")
<div class="row mt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="table-responsive">
                        <table class="border table mb-0 myTable" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product & Quantity</th>
                                    <th>Sub Total</th>
                                    <th> Total</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->isNotEmpty())
                                <?php
                                $i = 1;
                                ?>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$i++}}</td>

                                    <td>{{$order->invoice}}</td>
                                    <td>
                                        <p>{{$order->user->name}}</p>
                                        <p><i class="ti-email text-dark"></i> <a href="mailto: {{$order->user->email}}">{{$order->user->email}}</a></p>
                                        <p> <i class="ti-mobile text-dark"></i>{{$order->user->phone}}</p>
                                    </td>
                                    <td>
                                        @if($order->order_details)
                                        @foreach($order->order_details as $od)
                                        <p> <a href="{{route('product.details',[$od->product->id, $od->product->title])}}"><strong>{{$od->product->title}}</strong></a> * {{$od->quantity}}</p>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->order_details)
                                        @foreach($order->order_details as $od)
                                        <p>
                                            {{$od->subtotal}} SAR

                                        </p>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{$order->total}} SAR</td>
                                    <td>
                                        <span class="badge bg-primary mt-2">{{$order->order_status}}</span>
                                    </td>
                                    <td>
                                        <a href="{{route('order.details',$order->id)}}" class="btn  btn-sm btn-sm btn-dark m-2"><i class="fa fa-eye"></i>Details</a>
                                        <a class="btn btn-sm btn-danger m-2" data-bs-toggle="modal" data-bs-target="#delete{{$order->id}}"><i class="fa fa-trash text-white"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Want to delete this order?</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <form action="{{route('delete.order',$order->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <a href="" class="btn btn-sm btn-dark m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$order->id}}"><i class="fa fa-edit text-white"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{$order->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel"><strong>Change Order Status</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('change.order.status',$order->id)}}" method="post">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <select name="order_status" id="" class="form-control">
                                                                    <option value="">Choose One</option>
                                                                    <option value="order confirmed" {{$order->order_status=="order confirmed" ? 'selected' : ''}}>Order Confirmed</option>
                                                                    <option value="payment confirmed" {{$order->order_status=="payment confirmed" ? 'selected' : ''}}>Payment Confirmed</option>
                                                                    <option value="on the process" {{$order->order_status=="on the process" ? 'selected' : ''}}>On The Process</option>
                                                                    <option value="ready to pickup" {{$order->order_status=="ready to pickup" ? 'selected' : ''}}>Ready To Pickup</option>
                                                                    <option value="delivered" {{$order->order_status=="delivered" ? 'selected' : ''}}>Delivered</option>
                                                                    <option value="cancel" {{$order->order_status=="cancel" ? 'selected' : ''}}>Cancel</option>
                                                                </select>
                                                                <button class="btn btn-dark mt-4 text-white"> <i class="fa fa-save text-whtie"></i> Save Information</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                </tr>

                                @endforeach
                                <?php
                                $i = $i + 1;
                                ?>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@else

<div class="container-fluid mt-4 mb-4">
    <div class="row justify-content-center  mt-4 mb-4">

        <!-- left panel -->
        <div class="col-lg-4 col-sm-9 mb-2-3 mb-lg-0 card p-2">

            <div class="account-pannel">

                <div class="p-4">

                    <div class="text-center">

                        <h6 class="mb-0 display-28 text-capitalize">{{auth()->user()->name}}</h6>
                        <small><strong>Email: </strong> {{auth()->user()->email}}</small> <br>
                        <small><strong>Phone: </strong> {{auth()->user()->phone}}</small> <br>

                        <a href="" data-toggle="modal" data-target="#exampleModalCenter{{auth()->user()->id}}"> <i class="fa fa-edit"></i></a>
                    


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{auth()->user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('update.profile',auth()->user()->id) }}">
                                                @csrf
                                                @method('patch')
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{auth()->user()->name}}" required autocomplete="name" autofocus>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="phone" type="number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{auth()->user()->phone}}" required autocomplete="phone" autofocus>

                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{auth()->user()->email}}" required autocomplete="email">

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-dark text-white"><i class="fa fa-upload"></i>Update information</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="list-group text-center">
                    <a class="list-group-items card-header" href="/home"><i class="ti-bag pe-2"></i>Orders</a>
                    <a class="list-group-items card-header" href="{{route('wishlists')}}"><i class="ti-heart pe-2"></i>Wishlist</a>
                    <a class="list-group-items card-header" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>

        </div>
        <!-- end left panel -->

        <!-- right panel -->
        <div class="col-lg-8">

            <div class="common-block">

                <div class="inner-title card-header">
                    <h4 class="mb-0">Order Summary</h4>
                </div>

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table mb-0 myDataTable" id="myDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Product & Quantity</th>
                                    <th>Sub Total</th>
                                    <th> Total</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->isNotEmpty())
                                <?php
                                $i = 1;
                                ?>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$order->invoice}}</td>
                                    <td>
                                        @if($order->order_details)
                                        @foreach($order->order_details as $od)
                                        <p> <a href="{{route('product.details',[$od->product->id, $od->product->title])}}"><strong>{{$od->product->title}}</strong></a> * {{$od->quantity}}</p>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->order_details)
                                        @foreach($order->order_details as $od)
                                        <p>
                                            {{$od->subtotal}} SAR

                                        </p>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{$order->total}} SAR</td>
                                    <td>
                                        <span class="badge bg-success mt-2">{{$order->order_status}}</span>
                                    </td>
                                    <td>

                                        <a href="{{route('order.details',$order->id)}}" class="btn btn-sm btn-dark m-2"><i class="fa fa-eye "></i>Details</a>

                                        @if($order->review)
                                        <div class="col-md-12 mt-4">
                                            <p><strong>Reviewed:</strong> </p>
                                            <span class="text-warning">
                                                @for($i=1;$i<$order->review->star;$i++)
                                                    <i class="fa fa-star"></i>
                                                    @endfor
                                            </span>
                                            <p><strong>comment:</strong> {{$order->review->comment}}</p>
                                        </div>
                                        @else
                                        @if($order->order_status=="delivered")
                                        <a href="" class="btn btn-sm btn-warning m-2" data-toggle="modal" data-target="#reveiw{{$order->id}}"><i class="fa fa-star "></i>Review Us</a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="reveiw{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Review Us <i class="fa fa-star"></i></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{route('review.store')}}" method="post">
                                                            @csrf
                                                            <div class="row">

                                                                <div class="col-md-12 mb-2">

                                                                    <div class="form-group">
                                                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                                        <label>Rating</label>
                                                                        <select class="form-control form-select" name="star">
                                                                            <option value="5">5 Stars</option>
                                                                            <option value="4">4 Stars</option>
                                                                            <option value="3">3 Stars</option>
                                                                            <option value="2">2 Stars</option>
                                                                            <option value="1">1 Star</option>
                                                                        </select>
                                                                    </div>

                                                                </div>



                                                                <div class="col-md-12  mb-4">

                                                                    <label>Comment</label>
                                                                    <div class="form-group mb-1">
                                                                        <textarea rows="2" class="form-control" placeholder="Tell us a few words" name="comment"></textarea>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <button type="submit" class="btn btn-dark">Submit Review</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @endif

                                    </td>

                                </tr>

                                @endforeach
                                <?php
                                $i = $i + 1;
                                ?>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- end right panel -->
    </div>
</div>

@endif
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();
    });
</script>
@endsection