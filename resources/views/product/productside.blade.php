<?php

use App\Banner;
use App\Category;
use App\Product;

$banners = Banner::latest()->take(6)->get();
$categories = Category::orderBy('category')->get();
$products=Product::orderBy('id','desc')->paginate(10);
?>
<div class="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50" >
    <!-- Block Product Categories -->
    <div class="block block-product-cats">
        <div class="block-title">
            <h2 class="card-header">Categories</h2>
        </div>
        <div class="block-content  card p-2">
            <div class="product-cats-list">
                <ul>
                    @if($categories->isNotEmpty())
                    @foreach($categories as $category)
                    <li class="current">
                        <a href="{{route('category.product',[$category->id,$category->category])}}">{{$category->category}} <span class="count text-capitalize">
                                @if($category->product)
                                {{$category->product->count()}}
                                @endif
                            </span></a>
                    </li>
                    @if($category->sub_category->isNotEmpty())
                    @foreach($category->sub_category as $sub_category)

                    <li class="current">
                        <a href="{{route('sub_category.product',[$sub_category->id, $sub_category->sub_category])}}">{{$sub_category->sub_category}} <span class="count text-capitalize">
                                @if($sub_category->product)
                                {{$sub_category->product->count()}}
                                @endif
                            </span></a>
                    </li>
                    @endforeach
                    @endif

                    @if($sub_category->sub_sub_category->isNotEmpty())
                    @foreach($sub_category->sub_sub_category as $sub_sub_category)

                    <li class="current">
                        <a href="{{route('subsub_category.product',[$sub_sub_category->id, $sub_sub_category->sub_sub_category])}}">{{$sub_sub_category->sub_sub_category}} <span class="count text-capitalize">
                                @if($sub_sub_category->product)
                                {{$sub_sub_category->product->count()}}
                                @endif
                            </span></a>
                    </li>
                    @endforeach
                    @endif

                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>





    <!-- Block Product Filter -->
    <div class="block block-product-filter clearfix">
        <div class="block-title">
            <h2>Hot Sales</h2>
        </div>
        <div class="block-content">
            <ul class="filter-items image">
                @if($banners->isNotEmpty())
                @foreach($banners as $banner)
                <li><span>
                        <a href="{{$banner->link}}"><img src="{{$banner->image}}" alt="Brand"></a>
                    </span></li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>

</div>