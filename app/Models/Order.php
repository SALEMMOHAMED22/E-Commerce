<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_name',
     'user_phone', 'user_email', 'price', 'shipping_price',
      'total_price', 'note', 'status', 'country', 'governorate', 'city', 
      'street', 'coupon' , 'coupon_discount'];


      public function orderItems(){
          return $this->hasMany(OrderItem::class);
      }
      public function user(){
          return $this->belongsTo(User::class);
      }
      public function getCreatedAtAttribute($value){
          return date('Y-m-d', strtotime($value));
      }
      public function getTotalAttribute($value){
          return number_format($value);
      }
      
}
