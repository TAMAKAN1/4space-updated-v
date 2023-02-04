@extends('layouts.frontend.app')
@section('content')
<style>
    .product-grid-two .product-block a:hover {
        color: black !important
    }
</style>
<section class="py-0">
    <div class="container">
        <div class="row mt-4 mb-4">
            @foreach($category->sub_category as $sub)
            <div class="col-md-4">
                @if($sub->sub_sub_category)
                <div class="owl-item " style="width: 301.5px; margin-right: 30px;">
                    <div class="product-grid-two">
                        @if($sub->image)
                        <div class="product-img">
                            <a href="{{route('subsubcategory',[$sub->id,$sub->sub_category])}}"><img class="img-alt" src="{{$sub->image}}" alt="..."></a>
                        </div>
                        @endif
                        <div class="product-block  text-center">
                            <a href="{{route('subsubcategory',[$sub->id,$sub->sub_category])}}" class="text-dark"><span><strong>{{$sub->sub_category }}</strong></span></a>
                        </div>
                    </div>
                </div>
                @else
                <div class="owl-item " style="width: 301.5px; margin-right: 30px;">
                    <div class="product-grid-two">
                        @if($sub->image)
                        <div class="product-img">
                            <a href="{{route('sub_category.product',[$sub->id,$sub->sub_category])}}"><img class="img-alt" src="{{$sub->image}}" alt="..."></a>
                        </div>
                        @endif
                        <div class="product-block  text-center">
                            <a href="{{route('sub_category.product',[$sub->id,$sub->sub_category])}}" class="text-dark"><span><strong>{{$sub->sub_category }}</strong></span></a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection