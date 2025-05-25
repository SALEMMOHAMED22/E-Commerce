<?php

namespace App\Livewire\Website;

use App\Models\Cart;
use Livewire\Component;
use App\Models\CartItem;

class ProductDetails extends Component
{

    public $product;
    public $variantId;
    public $quantity;
    public $price;


    public $cartQuantity = 1;
    public $cartAttributesArray = [];



    public function mount()
    {
        $this->product = $this->product;
        $this->variantId = $this->product->has_variants ? $this->product->variants->first()->id : null;
        $this->price = $this->product->has_variants ? $this->product->variants->first()->price : null;
        $this->quantity = $this->product->has_variants ? $this->product->variants->first()->stock : $this->product->quantity;
    }

    public function changeVariant($variantId)
    {

        $variant = $this->product->variants->find($variantId);
        if (!$variant) {
            return response()->json(['message' => 'Invalid Variant'], 404);
        }

        $this->changePropertiesVaues($variant);
    }

    public function changePropertiesVaues($variant)
    {
        $this->variantId = $variant->id;
        $this->price     = $variant->price;
        $this->quantity  = $variant->stock;
    }

    public function incrementCartQuantity()
    {
        $this->cartQuantity++;
    }

    public function decrementCartQuantity()
    {
        if ($this->cartQuantity > 1) {
            $this->cartQuantity--;
        }
    }


    public function addToCart()
    {

        $product = $this->product;
        $userId = auth('web')->user()->id;
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        if (!$product->has_variants) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->whereNull('product_variant_id')
                ->first();


            if ($cartItem) {
                // if($cartItem->quantity + $this->cartQuantity > $product->quantity){
                //     $this->dispatch('errorMessage' , 'The quantity is greater than the available quantity');
                //     return false;
                // }
                $cartItem->increment('quantity', $this->cartQuantity);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $this->cartQuantity,
                    'price' => $product->getPriceAfterDiscount(),
                    'product_variant_id' => null,
                ]);
            }

          
        }else{
            $variant = $product->variants->find($this->variantId);
            $variant->load('variantAttributes');

            // check if the same variant is already in the cart

            $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_variant_id' , $variant->id)
            ->first();

            if($cartItem){
                $cartItem->increment('quantity' , $this->cartQuantity);
            }else{

                foreach($variant->variantAttributes as $variantAttribute){
                        $this->cartAttributesArray[$variantAttribute->attributeValue->attribute->name] = $variantAttribute->attributeValue->value;
                }

                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $this->cartQuantity,
                    'price' => $variant->price,
                    'product_variant_id' => $this->variantId,
                    'attributes' => json_encode($this->cartAttributesArray , JSON_UNESCAPED_UNICODE),
                ]);
            }

        }

          $this->dispatch('successMessage', __('website.Product added to cart successfully'));
            $this->dispatch('refreshCartIcon');
    }
    public function render()
    {
        return view('livewire.website.product-details', [
            'variants' => $this->product->variants,
        ]);
    }
}



