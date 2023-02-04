<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'title','category_id','sub_category_id','sub_sub_category_id','price','fabric','width','height','color','custom_status','product_details','status','SKU',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');

    }
    public function sub_category(){
        return $this->belongsTo(Subcategory::class,'sub_category_id');

    }
    public function sub_sub_category(){
        return $this->belongsTo(SubSubCategory::class,'sub_sub_category_id');

    }
    public function images(){
        return $this->hasMany(ProductFile::class,'product_id');
    }
    public function wishlist(){
        return $this->hasMany(Wishlisht::class,'product_id');
    }
    public function order_details(){
        return $this->hasMany(OrderDetails::class,'product_id');

    }
    public function review_details(){
        return $this->hasMany(ReviewDetails::class,'product_id');
    }

    
}
