<?php
$banners = App\Banner::orderBy('id', 'desc')->get();
$categories = App\Category::all();
?>
   <!-- sidebar panel -->
   <div class="col-lg-3 col-12 side-bar order-2 order-lg-1">
                <div class="widget">
                    <div class="widget-title">
                        <h5>Categories</h5>
                    </div>
                    <div id="accordion" class="accordion-style2">
                        @if($categories)
                        @foreach($categories as $category)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                @if($category->sub_category->isNotEmpty())
                                <h5 class="mb-0">
                                    <button class="btn btn-link " data-bs-toggle="collapse" data-bs-target="#collapseOne{{$category->id}}" aria-expanded="true" aria-expanded="true" aria-controls="collapseOne">{{ $category->category}}</button>
                                </h5>
                                @else
                                <h5 class="mb-0">
                                    <a href="{{route('category.product',[$category->id,$category->category])}}" class="btn btn-link ">{{ $category->category}}</a>
                                </h5>
                                @endif
                            </div>
                            @if($category->sub_category)

                            @foreach($category->sub_category as $sub)

                            <div id="collapseOne{{$category->id}}" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion" style="">
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><a href="{{route('sub_category.product',[$sub->id,$sub->sub_category])}}"><strong>{{$sub->sub_category}}</strong></a>
                                            @if($sub->sub_sub_category)
                                            @foreach($sub->sub_sub_category as $subsubcategory)
                                            <ul class="list-unstyled">
                                                <li><a href="{{route('subsub_category.product',[$subsubcategory->id,$subsubcategory->sub_sub_category])}}">{{$subsubcategory->sub_sub_category}}</a>
                                            </ul>
                                            @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>







                <div class="offer-slider owl-carousel owl-theme owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-612px, 0px, 0px); transition: all 1s ease 0s; width: 2142px;">
                            @if($banners)
                            <?php
                            $i = 1;
                            ?>
                            @foreach($banners as $banner)
                            <div class="owl-item {{$i==1 ? 'active' : 'cloned'}}" style="width: 306px;">
                                <div class="offer-banner-slider" style="background-image:url({{$banner->image}});">
                                    <div class="offer-text">
                                        <h4 class="font-weight-500 text-white"><a href="#" class="text-white">{{$banner->title}}</a></h4>
                                        <a class="butn-style1 fill small" href="{{route('all.products')}}"><span>Shop Now</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i = $i + 1;
                            ?>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                    <div class="owl-dots disabled"></div>
                </div>

            </div>