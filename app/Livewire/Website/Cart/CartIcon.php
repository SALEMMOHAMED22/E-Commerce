<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;
use Livewire\Attributes\On;

class CartIcon extends Component
{

    public function removeFromCart($id){

        $authBoolean = auth('web')->check();
        if($authBoolean){
          
           $cartItem = auth('web')->user()->cart->items()->where('id' , $id)->first();
           $cartItem->delete();
            $this->dispatch('updateCart');

        }
        $this->dispatch('orderSummaryRefresh');
    }

    #[On('refreshCartIcon')]
    public function render()
    {
        $authBoolean = auth('web')->check();
        $cartItemsCount = $authBoolean ? auth('web')->user()->cart->items->count() : 0;
        $cartItems = $authBoolean ? auth('web')->user()->cart->items : [];


        return view('livewire.website.cart.cart-icon' , [
            'cartItemsCount' => $cartItemsCount,
            'cartItems' => $cartItems,
        ]);
    }
}
