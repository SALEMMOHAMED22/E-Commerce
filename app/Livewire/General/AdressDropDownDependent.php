<?php

namespace App\Livewire\General;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use Livewire\Component;

class AdressDropDownDependent extends Component
{
    public $countryId , $governorateId , $cityId ;

    public function render()
    {
        return view('livewire.general.adress-drop-down-dependent' , [
            'countries' => Country::get(),
            'governorates' => $this->countryId ? Governorate::where('country_id' , $this->countryId)->get() : [] ,
            'cities' => $this->governorateId ? City::where('governorate_id' , $this->governorateId)->get() : []

        ]);
    }
}
