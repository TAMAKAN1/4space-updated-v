<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'comment', 'star','order_id'
    ];

   

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function review_details(){
        return $this->hasOne(ReviewDetails::class,'order_id');
    }
}
