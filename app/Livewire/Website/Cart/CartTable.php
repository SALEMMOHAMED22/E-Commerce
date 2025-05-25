<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;
use App\Models\CartItem;
use Livewire\Attributes\On;

class CartTable extends Component
{

    public function removeItem($id)
    {
        $item = CartItem::find($id);
        $item->delete();
        $this->dispatch('refreshCartIcon');
    }

    public function increamentCartQuantity($id)
    {
        $item = CartItem::find($id);
        $item->quantity += 1;
        $item->save();
    }
  
    public function decrementCartQuantity($id)
    {
        $item = CartItem::find($id);
        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        }
    }
    public function clearCart(){
        $authUser = auth('web')->user();
        $cart = $authUser->cart;
        $cart->items()->delete();
        $this->dispatch('refreshCartIcon'); 
    }



    #[On('updateCArt')]
    public function render()
    {

        $authUser = auth('web')->user();
        $cart = $authUser->cart;

        $cart->load('items.product.images');
        return view('livewire.website.cart.cart-table', [
            'cartItems' => $cart->items,
        ]);
    }
}
