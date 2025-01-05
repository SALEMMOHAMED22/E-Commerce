<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CouponRepository;
use Yajra\DataTables\Facades\DataTables;

class CouponService
{
   protected $couponRepository;
    public function __construct(CouponRepository $couponRepository)
    {
        return $this->couponRepository = $couponRepository;
    }

    public function getCoupon($id){
        $coupon = $this->couponRepository->getCoupon($id);
        return $coupon?? abort(404);
    }

    public function getCouponsForDatatables(){
        $coupons = $this->couponRepository->getCoupons();

        return DataTables::of($coupons)
        ->addIndexColumn()
        ->addcolumn('is_active' , function($row){
            return $row->status();
        })
        ->addcolumn('discount_precentage' , function($row){
            return $row->discount_precentage . ' % ';
        })
        ->addColumn('action' , function($coupon){
            return view('dashboard.coupons.datatables.actions' , compact('coupon'));
        })
        ->make(true);

    
    }

    public function createCoupon($data){
        return $this->couponRepository->createCoupon($data);
    }

    public function updateCoupon($id , $data){
        $coupon = $this->getCoupon($id);
        return $this->couponRepository->updateCoupon($coupon , $data);
    }

    public function deleteCoupon($id){
        $coupon = $this->getCoupon($id);
        return $this->couponRepository->deleteCoupon($coupon);
    }
    
}
