<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable=[
        'name','email','phone','full_address','city','zipcode','link','order_id'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
