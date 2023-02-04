<?php

namespace App\Http\Controllers;

use App\Review;
use App\ReviewDetails;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $review =  Review::create([
            'comment' => $request->comment,
            'star' => $request->star,
            'order_id' => $request->order_id,
        ]);
        
        foreach ($review->order->order_details as $od) {
            ReviewDetails::create([
                'comment' => $request->comment,
                'star' => $request->star,
                'product_id'=>$od->product->id,
                'review_id'=> $review->id,
                'user_id'=>$request->user_id
            ]);

        }
        toastr()->success('Thanks For Reviewed!');
        return redirect()->back();
    }
}
