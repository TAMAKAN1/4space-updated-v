<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Logo;
use App\Silder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSetting extends Controller
{
    public function logo()
    {
        return view('sitesetting.addlogo');
    }
    public function logostore(Request $request)
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/website/' . '/logo/' . $filename;
            $file->move(public_path() . "/backend/" . "/website/" . "/logo/", $filename);
        }
        Logo::create([
            'place' => $request->place,
            'logo' => $path
        ]);
        toastr()->success('added');
        return redirect()->back();
    }
    public function delete(Logo $logo)
    {
        $image_path = public_path() . $logo->logo;
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
        }
        $logo->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }
    public function sliderstore(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/website/' . '/slider-image/' . $filename;
            $file->move(public_path() . "/backend/" . "/website/" . "/slider-image/", $filename);
        }
        Silder::create([
            'title' => $request->title,
            'image' => $path,
            'link' => $request->link
        ]);
        toastr()->success('added');
        return redirect()->back();
    }
    public function update(Request $request, Silder $slider)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/website/' . '/slider-image/' . $filename;
            $file->move(public_path() . "/backend/" . "/website/" . "/slider-image/", $filename);
        } else {
            $path = $slider->image;
        }
        $slider->update([
            'title' => $request->title,
            'image' => $path,
            'link' => $request->link
        ]);
        toastr()->success('Updated ');
        return redirect()->back();
    }
    public function deleteSlider(Silder $slider){
        $image_path = public_path() . $slider->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
         }
        $slider->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }

    public function banner_store(Request $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/website/' . '/bannger-image/' . $filename;
            $file->move(public_path() . "/backend/" . "/website/" . "/bannger-image/", $filename);
        }
        Banner::create([
            'title' => $request->title,
            'link' => $request->link,
            'image' => $path,
        ]);
        toastr()->success('Banner Added');
        return redirect()->back();
    }
    public function update_banner(Request $request, Banner $banner){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/backend/' . '/website/' . '/bannger-image/' . $filename;
            $file->move(public_path() . "/backend/" . "/website/" . "/bannger-image/", $filename);
        }else{
            $path=$banner->image;
        }
        $banner->update([
            'title' => $request->title,
            'link' => $request->link,
            'image' => $path,
        ]);

        toastr()->success('Banner Update');
        return redirect()->back();
    }

    public  function delete_banner(Banner $banner){
        $image_path = public_path() . $banner->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
            //unlink($image_path);
         }
        $banner->delete();
        toastr()->success('Deleted');
        return redirect()->back();
    }
}
