<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    protected $fillable=[
        'sub_category_id','sub_sub_category','image'
    ];
    public function sub_category(){
        return $this->belongsTo(Subcategory::class,'sub_category_id');
    }
    public function product(){
        return $this->hasMany(Product::class,'sub_sub_category_id');
    }
}
