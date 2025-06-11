<?php

namespace App\Repositories\Dashboard;

use App\Models\Order;

class OrderRepository
{
   

    public function getOrder($id){
        return Order::find($id);
    }
    public function getOrders(){
        return Order::query()->latest();
    }

    public function markOrderAsDelivered($order){
        return $order->update(['status' => 'delivered']);
    }
    public function getOrderWithItemsById($id){
        return Order::with('orderItems')->find($id);
    }

    public function deleteOrder($order){
        return $order->delete();
    }


}
