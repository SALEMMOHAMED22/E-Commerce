<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Services\Dashboard\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;
    public function __construct(CouponService $couponService)
    {
        return $this->couponService = $couponService;
    }

    public function index()
    {
        return view('dashboard.coupons.index');
    }
    public function getAll()
    {
        return $this->couponService->getCouponsForDatatables();
    }


    public function create()
    {
        return view('dashboard.coupons.create');
    }


    public function store(CouponRequest $request)
    {
        $data = $request->except(['_token']);
        $coupon = $this->couponService->createCoupon($data);
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 201);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(CouponRequest $request, string $id)
    {
        $data = $request->except(['_token']);
        $coupon = $this->couponService->updateCoupon($id, $data);
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 200);
    }


    public function destroy(string $id)
    {
        $coupon = $this->couponService->deleteCoupon($id);
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 200);
    }
}
