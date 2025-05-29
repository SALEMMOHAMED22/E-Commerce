<?php

namespace App\Livewire\Website\Checkout;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use App\Models\Governorate;
use App\Models\ShippingGovernorate;

class ShippingDetails extends Component
{
    public $countryId, $governorateId, $cityId;

    // public function updateGovernorateId()
    // {
    //     $price = ShippingGovernorate::where('governorate_id', $this->governorateId)->first()->price;

    //     $this->dispatch('shippingPriceUpdated', $price);
    // }
    public function updatedGovernorateId($value)
    {
        $shipping = ShippingGovernorate::where('governorate_id', $value)->first();
        $price = $shipping?->price ?? 0;

        $this->dispatch('shippingPriceUpdated', $price);
    }
    public function render()
    {
        return view('livewire.website.checkout.shipping-details', [
            'countries' => Country::get(),
            'governorates' => $this->countryId ? Governorate::where('country_id', $this->countryId)->get() : [],
            'cities' => $this->governorateId ? City::where('governorate_id', $this->governorateId)->get() : [],
        ]);
    }
}
