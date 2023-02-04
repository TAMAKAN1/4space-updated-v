<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
   protected $fillable=[
    'category_id','sub_category','image'
   ];
   public function category(){
    return $this->belongsTo(Category::class,'category_id');
   }
   public function sub_sub_category(){
    return $this->hasMany(SubSubCategory::class,'sub_category_id');
   }
   public function product(){
      return $this->hasMany(Product::class,'sub_category_id');
   }
}
