<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Attributes\On;
use Livewire\Component;

class WishlistIcon extends Component
{
    #[On('wishlistRefreshCount')]
    public function render()
    {
        $count = auth('web')->user() ? auth('web')->user()->wishlists()->get()->count() : 0;
        return view('livewire.website.wishlist.wishlist-icon' ,
        [
            'wishlistCount' => $count,
        ]
    );
    }
}
