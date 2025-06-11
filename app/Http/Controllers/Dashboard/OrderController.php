<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Dashboard\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    protected $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function index(){
        return view('dashboard.orders.index');
    }


    public function getAll(Request $request){
        return $this->orderService->getAllOrdersForDatatable($request);
    }

    public function show($id){
        $orderWithItems = $this->orderService->getOrderWithItems($id);

        if(!$orderWithItems){
            Session::flash('error' , 'order not found');
            return redirect()->route('dashboard.orders.index');
        }

        return view('dashboard.orders.show' , compact('orderWithItems'));
    }

    public function markDelivered($id){
        $order = $this->orderService->markOrderAsDelivered($id);
        if(! $order){
            Session::flash('error' , 'can not mark order as delivered');
            return redirect()->back();
        }
        Session::flash('success' , 'order marked as delivered successfully');
        return redirect()->back();
    }



    public function destroy($id){
        $order = $this->orderService->deleteOrder($id);
        if(! request()->expectsJson()){
            if(!$order){
                Session::flash('error' , 'can not delete order');
                return redirect()->back();
            }
            Session::flash('success' , 'order deleted successfully');
            return redirect()->route('dashboard.orders.index');




        }

        if(!$order){
            return response()->json([
                'status' => 'error',
                'message' => 'can not delete order',

            ] , 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'order deleted successfully',
        ] , 200);
    }
}
