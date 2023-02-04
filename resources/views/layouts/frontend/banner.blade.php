<?php

use App\Banner;

$banners = Banner::latest()->take(8)->get();
?>
<section class="section section-small-padding">
      <!-- Block Product Branner -->
      <div class="block block-product-cats layout-6 x-small-space">
            <div class="block-content">
                  <div class="row">
                        @foreach($banners as $banner)
                        <div class="col-lg-3 col-md-6 md-b-10">
                              <div class="cat-item">
                                    <div class="cat-image">
                                          <a href="{{route('all.products')}}">
                                                <img width="469" height="475" src="{{$banner->image}}" alt="Product Branner">
                                          </a>
                                    </div>

                                    <div class="cat-title">

                                       
                                          <a href="{{route('all.products')}}">
                                                {{$banner->title}}
                                          </a>
                                    </div>
                              </div>
                        </div>
                        @endforeach
                  </div>
            </div>
      </div>
</section>