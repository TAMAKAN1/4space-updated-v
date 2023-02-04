<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'invoice','user_id','total','payment_status','note','order_status'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function order_details(){
        return $this->hasMany(OrderDetails::class,'order_id');
    }
    public function shipping(){
        return $this->hasOne(Shipping::class,'order_id');
    }
    public function review(){
        return $this->hasOne(Review::class,'order_id');
    }
}
