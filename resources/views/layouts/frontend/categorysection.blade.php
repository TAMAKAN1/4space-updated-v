<?php

use App\Subcategory;

$subcategories = Subcategory::latest()->take(8)->get();
?>
<section>
    <div class="container-fluid">
        <div class="text-center mb-1-9 mb-lg-2-3">
            <h2 class="mb-0">Latest Categories</h2>
        </div>
        <div class="row justify-content-center mt-n1-9">
            @if($subcategories->isNotEmpty())
            @foreach($subcategories as $subcategory)
                <div class="col-10 col-sm-6 col-lg-3 mt-1-9">
                    <a href="{{route('sub_category.product',[$subcategory->id,$subcategory->sub_category])}}"><img src="{{$subcategory->image}}" alt="..."></a>
                    <h3 class="mb-2 display-29 mt-3 letter-spacing-1 text-uppercase"><a href="/">{{$subcategory->sub_category}}</a></h3>
                    <ul class="categories-style ps-0 mb-0">
                        @if($subcategory->sub_sub_category)
                        <?php
                           $subsubcategories=App\SubSubCategory::where('sub_category_id',$subcategory->id)->take(4)->get();
                        ?>
                        @foreach( $subsubcategories as $subsubcategory)
                        <li><a href="{{route('subsub_category.product',[$subsubcategory->id, $subsubcategory->sub_sub_category])}}"> {{$subsubcategory->sub_sub_category}} </a></li>
                        @endforeach
                        @endif
                        <li>
                            <div><span><a href="{{route('subsubcategory',[$subcategory->id,$subcategory->sub_category])}}">More</a></span></div>
                        </li>
                    </ul>
                </div>

            @endforeach
            @endif
        </div>
    </div>
</section>