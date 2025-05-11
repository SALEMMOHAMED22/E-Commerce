<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Component;
use App\Models\Wishlist as ModelsWishlist;


class Wishlist extends Component
{
    public $product;
    public $inWishlist;

    public function mount($product)
    {
        $this->product = $product;

        if (auth('web')->check()) {
            $status = ModelsWishlist::where('product_id', $product->id)->where('user_id', auth('web')->user()->id)->first();

            $status ? $this->inWishlist = true : $this->inWishlist = false;
        }
    }

    public function addToWishlist($productId)
    {

        if (!auth('web')->check()) {
            return redirect()->route('website.login.get');
        }

        ModelsWishlist::create([
            'product_id' => $productId,
            'user_id' => auth('web')->user()->id,
        ]);

        $this->inWishlist = true;

        $this->dispatch('addToWishlist' , __('website.prodcut_added_to_wishlist'));
        $this->dispatch('wishlistRefreshCount');
        
    }

    public function removeFromWishlist($productId)
    {
        if (!auth('web')->check()) {
            return redirect()->route('website.login.get');
        }

        $wishlistProduct = ModelsWishlist::where('product_id', $productId)->where('user_id', auth('web')->user()->id)->first();

        if ($wishlistProduct) {
            $wishlistProduct->delete();
            $this->inWishlist = false;
        }

        $this->dispatch('removeFromWishlist' , __('website.prodcut_removed_from_wishlist'));

        $this->dispatch('wishlistRefreshCount');

    }
    public function render()
    {
        return view('livewire.website.wishlist.wishlist');
    }
}
