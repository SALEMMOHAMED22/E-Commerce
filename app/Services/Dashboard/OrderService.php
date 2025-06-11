<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\OrderRepository;
use Yajra\DataTables\Facades\DataTables;


class OrderService
{
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }



    public function getAllOrdersForDatatable($request)
    {
        $ordersQuery = $this->orderRepository->getOrders();

        if($request->has('status') && $request->status != ''){
             $ordersQuery->where('status' , $request->status);
        }

        return DataTables::of($ordersQuery)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return $row->status;
            })
            ->addColumn('coupon', function ($row) {
                return $row->coupon ?? __('dashboard.no_coupon');
            })
            ->addColumn('action', function ($row) {
                return view('dashboard.orders.datatables.action', compact('row'));
            })
            ->rawColumns(['image', 'action'])

            ->make(true);
    }



    public function getOrderWithItems($id){
        $order = $this->orderRepository->getOrderWithItemsById($id);
        if($order){
            return $order;
        }
        return false;
    }

    public function markOrderAsDelivered($id){
        $order = $this->orderRepository->getOrder($id);
        if($order){
            return $this->orderRepository->markOrderAsDelivered($order);
        }
        return false;
    }

    public function deleteOrder($id){
        $order = $this->orderRepository->getOrder($id);

        if(!$order){
            return false;
        }

        if($order->status == 'delivered' || $order->status == 'cancelled'){
            return $this->orderRepository->deleteOrder($order);
        }
        return false;


       
        
    }
}
