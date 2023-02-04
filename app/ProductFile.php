<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
    protected $fillable=[
        'product_id','file'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
