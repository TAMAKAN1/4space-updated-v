<?php

use App\Subcategory;
use App\SubSubCategory;

$subcategories = Subcategory::latest()->take(6)->get();
$subsubcategory = SubSubCategory::latest()->take(6)->get();
?>

<section class="section section-small-padding">

    <!-- Block Product Branner -->
    <div class="block block-product-cats layout-6 x-small-space">

        <div class="block-content">
            <div class="row">
                @foreach($subcategories as $sub_category)
                <div class="col-lg-4 col-md-6 md-b-10">
                    <div class="cat-item">
                        <div class="cat-image">
                            <a href="{{route('sub_category.product',[$sub_category->id,$sub_category->sub_category])}}">
                                <img width="469" height="475" src="{{$sub_category->image}}" alt="Product category">
                            </a>
                        </div>
                        <div class="cat-title">
                            <a href="{{route('sub_category.product',[$sub_category->id,$sub_category->sub_category])}}">
                                {{$sub_category->sub_category}}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                @foreach($subsubcategory as $sub_sub_category)
                <div class="col-lg-4 col-md-6 md-b-10">
                    <div class="cat-item">
                        <div class="cat-image">
                            <a href="{{route('subsub_category.product',[$sub_sub_category->id,$sub_sub_category->sub_sub_category])}}">
                                <img width="469" height="475" src="{{$sub_sub_category->image}}" alt="Product category">
                            </a>
                        </div>
                        <div class="cat-title">
                            <a href="{{route('subsub_category.product',[$sub_sub_category->id,$sub_sub_category->sub_sub_category])}}">
                                {{$sub_sub_category->sub_sub_category}}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>