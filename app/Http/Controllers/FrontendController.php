<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Subcategory;
use App\SubSubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function subcategory(Category $category)
  {
    return view('front_category.subCategory', compact('category'));
  }

  public function subsubcategory(Subcategory $subcategory)
  {
    return view('front_category.subsubCategory', compact('subcategory'));
  }
  public function details(Product $product)
  {
    return view('product.productDetails', compact('product'));
  }
  public function all_products()
  {
    $products = Product::orderBy('id', 'desc')->get();
    return view('product.allproducts', compact('products'));
  }

  public function category(Category $category)
  {
    $products = $category->product;
    return view('product.categorywishproduct', compact('category', 'products'));
  }
  public function sub_category(Subcategory $sub_category)
  {
    $products = $sub_category->product;
    return view('product.subcategory', compact('sub_category', 'products'));
  }
  public function sub_sub_category(SubSubCategory $sub_sub_category)
  {
    $products = $sub_sub_category->product;
    return view('product.subsubcategory', compact('sub_sub_category', 'products'));
  }
  public function search(Request $request)
  {
    $products = Product::where('title', 'like', '%' . $request->name . '%')->get();
    return view('product.search', compact('products'));
  }
}
