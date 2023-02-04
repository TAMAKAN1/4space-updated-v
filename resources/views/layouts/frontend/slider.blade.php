<?php

use App\Silder;

$sliders = Silder::orderBy('id', 'desc')->get();
?>
<section class="section section-small-padding m-t-10 m-b-10">
    <!-- Block Sliders -->
    <div class="block block-sliders layout-12 color-white auto-height nav-center">
        <div class="slick-sliders" data-autoplay="false" data-dots="true" data-nav="false" data-columns4="1" data-columns3="1" data-columns2="1" data-columns1="1" data-columns1440="1" data-columns="1">
            @foreach($sliders as $slider)
            <div class="item slick-slide">
                <div class="item-content">
                    <div class="content-image">
                        <img width="1920" height="1080" src="{{asset($slider->image)}}" alt="Image Slider">
                    </div>
                    <div class="item-info horizontal-center vertical-middle">
                        <div class="content text-center">
                            <h2 class="title-slider"><strong>{{$slider->title}}</strong> </h2>
                            <a class="button-slider button-white" href="{{asset($slider->link)}}"><strong>Buy Now</strong></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>