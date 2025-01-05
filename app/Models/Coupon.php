<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'code',
        'discount_precentage',
        'start_date',
        'end_date',
        'limit',
        'time_used',
        'is_active',
    ];

    public function getCreatedAtAttribute($value){
        return date('d/m/y H:i a' , strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d/m/y H:i a' , strtotime($value));
    }

    public function scopeValid($query){
        return $query->where('is_valid' , 1)
        ->where('end_date' , '<' , now())
        ->where('time_used' , '<' , 'limit');
    }

    public function scopeNotValid($query){
        return $query->where('is_valid' , 0)
        ->where('end_date' , '>' , now())
        ->where('time_used' , '>' , 'limit');
    }

    public function couponIsValid(){
        return $this->is_valid == 1 && $this->time_used < $this->limit && $this->end_date < now();
    }

    public function status(){
        return $this->is_active == 1 ? 'Active':'In Active';
    }
    
}
