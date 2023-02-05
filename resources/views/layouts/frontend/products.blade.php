<?php

use App\Product;

$allproduct = Product::latest()->take(12)->get();
?>

<section class="section section-padding m-b-30">
	<div class="section-container">
		<!-- Block Products -->
		<div class="block block-products slider">
			<div class="block-widget-wrap">
				<div class="block-title title-underline">
					<h2>Latest Products</h2>
					<div class="title-right">
						<a href="{{route('all.products')}}">View All</a>
					</div>
				</div>
				<div class="block-content">
					<div class="content-product-list slick-wrap">
						<div class="slick-sliders products-list grid" data-slidestoscroll="true" data-dots="false" data-nav="1" data-columns4="1" data-columns3="2" data-columns2="3" data-columns1="3" data-columns1440="4" data-columns="4">
							@foreach($allproduct as $product)
							<div class="item-product slick-slide">
								<div class="items">
									<div class="products-entry clearfix product-wapper">
										<div class="products-thumb">
											<div class="product-thumb-hover">
												<a href="{{route('product.details',[$product->id,$product->title])}}">
													@if($product->images)
													<img width="600" height="600" src="{{$product->images[0]->file}}" class="post-image" alt="">
													@if($product->images[1])
													<img width="600" height="600" src="{{$product->images[1]->file}}" class="hover-image back" alt="">
													@else
													<img width="600" height="600" src="{{$product->images[0]->file}}" class="hover-image back" alt="">
													@endif
													@endif
												</a>
											</div>
											<div class="product-button">
													<form action="{{route('store.cart',$product->id)}}" method="post">
														@csrf
														<button type="submit" class="btn btn-dark btn-sm">Add to cart</button>
													</form>
												<div class="btn-wishlist" data-title="Wishlist">
													<button class="product-btn">Add to wishlist</button>
												</div>

											</div>
										</div>
										<div class="products-content">
											<div class="contents text-center">
												<h3 class="product-title"><a href="{{route('product.details',[$product->id,$product->title])}}">{{$product->title}}</a></h3>
												<span class="price">{{$product->price}} SAR</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>