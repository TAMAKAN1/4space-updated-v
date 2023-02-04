<?php

namespace App\Http\Controllers;

use App\Wishlisht;
use Illuminate\Http\Request;

class WishlishtController extends Controller
{
    public function wishlist(Request $request)
    {
        Wishlisht::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
        ]);
        toastr()->success('Added into wishlist');
        return redirect()->back();
    }
    public function all()
    {
        $wishlists = Wishlisht::where('user_id', auth()->user()->id)->get();
        return view('wishlist', compact('wishlists'));
    }
    public function delete(Wishlisht $wishlist)
    {
        $wishlist->delete();
        toastr()->success('Remove into wishlist');
        return redirect()->back();
    }
}
