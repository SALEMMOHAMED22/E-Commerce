<?php

namespace App\Repositories\Dashboard;

use App\Models\Coupon;

class CouponRepository
{
   
    public function getCoupon($id){
        $coupon = Coupon::find($id);
        return $coupon;
    }

    public function getCoupons(){
        $coupons = Coupon::latest()->get();
        return $coupons;
    }

    public function createCoupon($data){
        return Coupon::create($data);
    }

    public function updateCoupon($coupon , $data){
        return $coupon->update($data);
    }

    public function deleteCoupon($coupon){
        return $coupon->delete();
    }
}
