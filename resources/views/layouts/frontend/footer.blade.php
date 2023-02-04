<?php

use App\Category;
use App\Logo;
use App\Subcategory;

$frontend = Logo::where('place', 'Homepage')->orderBy('id', 'desc')->first();
$categories = Category::latest()->take(8)->get();
$subcategories = Subcategory::latest()->take(8)->get();
?>
<footer id="site-footer" class="site-footer">
  <div class="footer">
    <div class="section-padding">
      <div class="section-container large">
        <div class="block-widget-wrap">
          <div class="row">
            <div class="col-lg-6 col-md-6 ">
              <div class="block block-menu">
                <h2 class="block-title"><strong>About Us</strong></h2>
                <div class="block-content">
                  <p class="text-left">


                    <strong>
                      4space is a one-stop shop offering smart furniture and furnishings for everyday living, at affordable prices.
                    </strong> <br>


                    At Home Box, we constantly research the market and endeavour to create products that fulfill the needs of our customers. Our aim is to fill the gap in the market for fashion-forward, contemporary home essentials at value-for-money prices. <br>

                    Owned and managed by the PEC invesment Group, the brand has an extensive range of great quality products. 4space has been successfully established across in Saudi Arabia.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6">
              <div class="block block-social text-center ">
              <h2 class="block-title"><strong>Contact Us</strong></h2>
              <a href="tel:0000" class="twitter"> <span  class="menu-item-text" ><i class="fa fa-phone"></i> 0000000000000 </span></a> <br>
              <a href="mailto:sales@4space.com.sa"><span class="menu-item-text"><i class="fa fa-envelope"> Sales@4space.com.sa</i></span></a> <br>
              <a href=""><span class="menu-item-text"><i class="fa fa-map-marker"> Riyadh, Saudi Aarabia</i></span></a>
              </div>
              <div class="block block-social text-center">
                <p>You Can find Us Here</p>
                <ul class="social-link">
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a href="#"><i class="fa fa-behance"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="section-padding">
      <div class="section-container large">
        <div class="block-widget-wrap">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="footer-center">
                <p class="copyright">Copyright © 2022. All Right Reserved By 4space </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</footer>