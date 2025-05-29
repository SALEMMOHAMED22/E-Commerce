<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderShippingRequest;
use App\Services\Website\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function showCheckoutPage(){
        return view('website.checkout');
    }


    public function checkout(OrderShippingRequest $request){

       

        $shipping = $request->validated();

        $createOrder = $this->orderService->createOrder($shipping);
        if(!$createOrder){
            Session::flash('error' , 'Order Not Found!');
            return redirect()->back(); 
        }

        Session::flash('success' , 'Order Created Successfully!');
        return redirect()->back(); 

    }
}
