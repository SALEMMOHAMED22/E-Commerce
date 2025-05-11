<?php

namespace App\Livewire\Website;

use Livewire\Component;

class ProductDetails extends Component
{

    public $product;
    public $variantId;
    public $quantity;
    public $price;


    public function mount(){
        $this->product = $this->product;
        $this->variantId = $this->product->has_variants ? $this->product->variants->first()->id : null;
        $this->price = $this->product->has_variants ? $this->product->variants->first()->price : null;
        $this->quantity = $this->product->has_variants ? $this->product->variants->first()->stock : $this->product->quantity;
    }

    public function changeVariant($variantId){

        $variant = $this->product->variants->find($variantId);
        if(!$variant){
            return response()->json(['message' => 'Invalid Variant'] , 404);
        }

        $this->changePropertiesVaues($variant);
    }

    public function changePropertiesVaues($variant){
        $this->variantId = $variant->id ;
        $this->price     = $variant->price;
        $this->quantity  = $variant->stock;
    }

    public function render()
    {
        return view('livewire.website.product-details' , [
            'variants' => $this->product->variants,
        ]);
    }
}
