<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Component;
use App\Models\Wishlist as WishlistModel;

class WishlistTable extends Component
{


    public function removeFromWishlist($productId){

        $wishlist = WishlistModel::find($productId);

        $wishlist->delete();

        $this->dispatch('wishlistRefreshCount');
    }

    public function clearWishlist(){
        // WishlistModel::where('user_id' , auth('web')->user()->id)->delete();
        auth('web')->user()->wishlists()->delete();
        $this->dispatch('wishlistRefreshCount');
    }


    public function render()
    {
        return view('livewire.website.wishlist.wishlist-table' , [
            'wishlists' => auth('web')->user()->wishlists()->get(),
        ]);
    }
}
