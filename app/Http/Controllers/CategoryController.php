<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.addCategory');
    }
    public function storecategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories'
        ]);

        Category::create([
            'category' => $request->category,
        ]);
        toastr()->success('added');
        return redirect()->back();
    }
    public function update(Category $category, Request $request)
    {
        $category->update($request->all());
        toastr()->success('Updated');
        return redirect()->back();
    }
    public function delete(Category $category)
    {
        $category->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }

    public function subcategory(Request $request)
    {
        $this->validate($request, [
            'sub_category' => 'required|unique:subcategories'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/subcategory/' . '/image/' . $filename;
            $file->move(public_path() . "/backend/" . "/subcategory/" . "/image/", $filename);
        }
        Subcategory::create([
            'category_id' => $request->category_id,
            'sub_category' => $request->sub_category,
            'image' => $path
        ]);
        toastr()->success('added');
        return redirect()->back();
    }

    public function updatesubcategory(Request $request, Subcategory $subcategory)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/subcategory/' . '/image/' . $filename;
            $file->move(public_path() . "/backend/" . "/subcategory/" . "/image/", $filename);
        } else {
            $path =   $subcategory->image;
        }
        $subcategory->update([
            'category_id' => $request->category_id,
            'sub_category' => $request->sub_category,
            'image' => $path
        ]);
        toastr()->success('Updated');
        return redirect()->back();
    }

    public function deletesub(Subcategory $subcategory)
    {
        $image_path = public_path() . $subcategory->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $subcategory->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }

    public function subsubcategory(Request $request)
    {
        $this->validate($request, [
            'sub_sub_category' => 'required|unique:sub_sub_categories'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/subsubcategory/' . '/image/' . $filename;
            $file->move(public_path() . "/backend/" . "/subsubcategory/" . "/image/", $filename);
        }
        SubSubCategory::create([
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category' => $request->sub_sub_category,
            'image' => $path
        ]);
        toastr()->success('added');
        return redirect()->back();
    }

    public function updatesubsubcategory(Request $request, subsubcategory $subsubcategory)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/subsubcategory/' . '/image/' . $filename;
            $file->move(public_path() . "/backend/" . "/subsubcategory/" . "/image/", $filename);
        } else {
            $path =   $subsubcategory->image;
        }
        $subsubcategory->update([
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category' => $request->sub_sub_category,
            'image' => $path
        ]);
        toastr()->success('Updated');
        return redirect()->back();
    }
    public function deletesubsub(SubSubCategory $subsubcategory)
    {
        $image_path = public_path() . $subsubcategory->image;
        //dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $subsubcategory->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }
}
