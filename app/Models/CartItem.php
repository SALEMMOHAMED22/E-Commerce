<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price',
        'attributes',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function variant(){
        return $this->belongsTo(ProductVariant::class , 'product_variant_id');
    }

    public function getAttributesAttribute($value)
    {
        return json_decode($value , true);
    }
}
