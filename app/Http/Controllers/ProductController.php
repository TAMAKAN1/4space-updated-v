<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductFile;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function addproduct()
    {
        return view('backend.addProduct');
    }
    public function fatchcategory(Category $category)
    {
        return view('backend.subcategory', compact('category'));
    }
    public function fatchsubcategory(Subcategory $sub_category)
    {
        return view('backend.subsubcategory', compact('sub_category'));
    }

    public function store(Request $request)
    {


        $product = Product::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
            'price' => $request->price,
            'fabric' => $request->fabric,
            'SKU' => $request->SKU,
            'width' => $request->width,
            'height' => $request->height,
            'color' => $request->color,
            'size' => $request->size,
            'custom_status' => $request->custom_status,
            'product_details' => $request->product_details,
        ]);
        if ($request->hasFile('file')) {
            $i = 0;
            foreach ($request->file('file') as $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = time() + $i . '.' . $extention;
                $path1 = "/backend/" . "/product/" . "/images/" . $filename;
                $file->move(public_path() .  "/backend/" . "/product/" . "/images/", $filename);
                ProductFile::create([
                    'product_id' => $product->id,
                    'file' => $path1 ?? ''
                ]);
                $i++;
            }
        }
        toastr()->success('Updated');
        return redirect()->route('allproducts');
    }
    public function allproducts()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.allProducts', compact('products'));
    }
    public function edit(Product $product)
    {
        return view('backend.edit', compact('product'));
    }
    public function imageDelete(ProductFile $image)
    {
        $image_path = public_path() . $image->file;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $image->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }

    public function update(Product $product, Request $request)
    {
        $product->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'SKU' => $request->SKU,
            'price' => $request->price,
            'fabric' => $request->fabric,
            'fabric' => $request->fabric,
            'width' => $request->width,
            'status' => $request->status,
            'height' => $request->height,
            'size' => $request->size,
            'color' => $request->color,
            'custom_status' => $request->custom_status,
            'product_details' => $request->product_details,
        ]);
        if ($request->hasFile('file')) {
            $i = 0;
            foreach ($request->file('file') as $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = time() + $i . '.' . $extention;
                $path1 = "/backend/" . "/product/" . "/images/" . $filename;
                $file->move(public_path() .  "/backend/" . "/product/" . "/images/", $filename);
                ProductFile::create([
                    'product_id' => $product->id,
                    'file' => $path1 ?? ''
                ]);
                $i++;
            }
        }

        toastr()->success('Update');
        return redirect()->back();
    }

    public function  delete(Product $product)
    {
        $product->delete();
        foreach ($product->images as $image) {
            $image_path = public_path() . $image->file;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $image->delete();
        }
        toastr()->success('Deleted');
        return redirect()->back();
    }

}
