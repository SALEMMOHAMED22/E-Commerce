<?php

namespace App\Services\Website;

use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\ShippingGovernorate;

class OrderService
{

    public function createOrder(array $shipping)
    {

        $countryName = $this->getLocationName(Country::class, $shipping['country_id']);
        $governorateName = $this->getLocationName(Governorate::class, $shipping['governorate_id']);
        $cityName = $this->getLocationName(City::class, $shipping['city_id']);

        if (!$countryName || !$governorateName || !$cityName) {
            return null;
        }

        $cart = $this->getUserCart();
        if (!$cart || $cart->items->isEmpty()) {
            return null;
        }

        $subTotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        $shippingPrice = $this->getShippingPrice($shipping['governorate_id']);

        //  Check if user has coupon 
        if ($coupon_exist = $cart->coupon != null) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_precentage / 100);
            }
        }

        $totalPrice = $subTotal + $shippingPrice;


        // Store Order 
        $order = Order::create([
            'user_id' => auth('web')->user()->id,
            'user_name' => $shipping['first_name'] . ' ' . $shipping['last_name'],
            'user_email' => $shipping['user_email'],
            'user_phone' => $shipping['user_phone'],
            'country' => $countryName,
            'governorate' => $governorateName,
            'city' => $cityName,
            'street' => $shipping['street'],
            'note' => $shipping['note'],
            'price' => $subTotal,
            'shipping_price' => $shippingPrice,
            'total_price' => $totalPrice,
            'coupon' => $coupon_exist && $coupon ? $coupon->code : null,
            'coupon_discount' => $coupon_exist && $coupon ? $coupon->discount_precentage : 0,

        ]);

        $this->storeOrderItemsFromCart($order, $cart);

        // $this->clearUserCart($cart);

        return $order;
    }

    private function getLocationName($modelClass, $id)
    {
        return $modelClass::find($id)?->name;
    }

    private function getUserCart(): ?Cart
    {
        return Cart::with('items.product')->where('user_id', auth('web')->user()->id)->first();
    }
    private function getShippingPrice($governorateId)
    {
        return ShippingGovernorate::where('governorate_id', $governorateId)->value('price') ?? 0.0;
    }
    private function storeOrderItemsFromCart(Order $order, Cart $cart)
    {
        foreach ($cart->items as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => optional($item->product)->name ?? 'unknown product',
                'product_desc' => optional($item->product)->small_desc ?? 'unknown',
                'product_quantity' => $item->quantity,
                'product_price' => $item->price,
                'attributes' => json_encode($item->attributes),
            ]);
        }
    }

    private function clearUserCart(Cart $cart): void
    {
        $cart->items()->delete();
        $cart->update(['coupon' => null]); //clear coupon 
    }
}
