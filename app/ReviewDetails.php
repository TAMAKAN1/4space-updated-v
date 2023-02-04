<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewDetails extends Model
{
    protected $fillable = [
        'comment', 'star', 'product_id', 'user_id','review_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   public function review(){
    return $this->belongsTo(Review::class,'review_id');
   }

}
