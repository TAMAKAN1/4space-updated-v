<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'category'
    ];
    public function sub_category(){
        return $this->hasMany(Subcategory::class,'category_id');
    }
    public function product(){
        return $this->hasMany(Product::class,'category_id');

    }
        
}
