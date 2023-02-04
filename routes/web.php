<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// frontend
Route::get('categories/{category}/{title}','FrontendController@subcategory')->name('subcategory');
Route::get('sub-categories/{subcategory}/{title}','FrontendController@subsubcategory')->name('subsubcategory');
//product
Route::get('Details/{product}/{title}','FrontendController@details')->name('product.details');
Route::get('latest-products','FrontendController@all_products')->name('all.products');
//categorywish product
Route::get('category-products/{category}/{title}','FrontendController@category')->name('category.product');
Route::get('sub-category-products/{sub_category}/{title}','FrontendController@sub_category')->name('sub_category.product');
Route::get('child-category-products/{sub_sub_category}/{title}','FrontendController@sub_sub_category')->name('subsub_category.product');

Route::get('search-result','FrontendController@search')->name('search.product');
//cart
Route::get('cart-items','OrderController@cartitems')->name('cart');
Route::post('store-cart-item/{product}','OrderController@addCart')->name('store.cart');
Route::delete('delete-cart/{product}', 'OrderController@destroyCart')->name('destroyCart');
Route::patch('update-cart/{product}', 'OrderController@updatecart')->name('update.cart');
// endfrontend
Route::get('auth/google', 'GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::post('store-wishlist','WishlishtController@wishlist')->name('store.wishlist');
Route::get('all-wishlists','WishlishtController@all')->name('wishlists');
Route::delete('remove-wishlist/{wishlist}','WishlishtController@delete')->name('delete.wishlist');
//profile

Route::get('profile','UserController@profile')->name('profile');
Route::patch('update-profile/{user}','UserController@update')->name('update.profile');
//checkout
Route::get('checkout', 'OrderController@checkout')->name('checkout');
Route::post('store-order','OrderController@order')->name('store.order');
Route::get('order-details/{order}','OrderController@orderDetails')->name('order.details');
//after order
Route::get('order-placed/{order}','OrderController@afterorder')->name('order.after.place');
Route::post('cancel-order/{order}','OrderController@customer_change_status')->name('cancel.customer.order');
//review
Route::post('store-review','ReviewController@store')->name('review.store');
});


Route::middleware(['Admin','auth'])->group(function () {
 Route::get('/site-setting','SiteSetting@logo')->name('site_setting');
 Route::post('add-logo','SiteSetting@logostore')->name('store.logo');
 Route::delete('/delete-logo/{logo}', 'SiteSetting@delete')->name('delete.logo');
 //slider
 Route::post('/store-slider', 'SiteSetting@sliderstore')->name('store.slider');
 Route::patch('/update-slider/{slider}','SiteSetting@update')->name('slider.update');
 Route::delete('/delete-slider/{slider}','SiteSetting@deleteSlider')->name('slider.delete');
 //category
 Route::get('add-category','CategoryController@index')->name('category');
 Route::post('store-category','CategoryController@storecategory')->name('store.category');
 Route::patch('update-category/{category}','CategoryController@update')->name('update.category');
 Route::delete('delete-category/{category}','CategoryController@delete')->name('delete.category');
 //subCategory
 Route::post('store-sub-category','CategoryController@subcategory')->name('subcategory.store');
 Route::patch('update-sub-category/{subcategory}','CategoryController@updatesubcategory')->name('subcategory.update');
 Route::delete('delete-sub-category/{subcategory}','CategoryController@deletesub')->name('subcategory.delete');
 //sub sub category
 Route::post('add-sub-sub-category','CategoryController@subsubcategory')->name('add.subsubcategory');
 Route::patch('update-subsubcategory/{subsubcategory}','CategoryController@updatesubsubcategory')->name('update.subsubcateogry');
 Route::delete('delete-sub-sub-category/{subsubcategory}','CategoryController@deletesubsub')->name('update.subsubcategory');
 //banner
 Route::post('store-bannger','SiteSetting@banner_store')->name('banner.store');
 Route::patch('update-banner/{banner}','SiteSetting@update_banner')->name('update.banner');
 Route::delete('delete-banner/{banner}','SiteSetting@delete_banner')->name('delete.banner');

 //product
 Route::get('add-product','ProductController@addproduct')->name('add-product');
 Route::get('/fatch-category/{category}','ProductController@fatchcategory')->name('fatch.category');
 Route::get('/fatch_subcategory/{sub_category}','ProductController@fatchsubcategory')->name('fatch.subcategory');
 Route::post('/store-product','ProductController@store')->name('product.store');
 Route::get('all-projects','ProductController@allproducts')->name('allproducts');
 Route::get('edit-product/{product}/{title}','ProductController@edit')->name('edit.product');
 Route::delete('delete-product-image/{image}','ProductController@imageDelete')->name('delete.image');
 Route::patch('update-product/{product}','ProductController@update')->name('product.update');
 Route::delete('delete-product/{product}','ProductController@delete')->name('delete.product');
 //order
 Route::delete('delete-order/{order}','OrderController@deleteOrder')->name('delete.order');
 Route::post('change-status/{order}','OrderController@change_status')->name('change.order.status');
});