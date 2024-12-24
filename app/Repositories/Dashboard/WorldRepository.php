<?php

namespace App\Repositories\Dashboard;

use App\Models\Country;
use App\Models\Governorate;

class WorldRepository
{

    public function getAllCountries(){
        $countries = Country::withCount(['governorates' , 'users'])->when(!empty(request()->keyword),function($query){
            $query->where('name' , 'like' , '%'.request()->keyword.'%');
        })->paginate(5);
       
        return $countries;
    }

    public function getAllGovernorates($country){
        $governorates = $country->governorates()
        ->with(['country' , 'shippingPrice'])
        ->withCount(['cities' , 'users'])->when(!empty(request()->keyword),function($query){
            $query->where('name' , 'like' , '%'.request()->keyword.'%');
        })->paginate(5);
        
        return $governorates;
    }

    public function getAllCities($governorate){
        $cities = $governorate->cities;
        return $cities;
    }
    public function getCountryById($id){
        $country = Country::find($id);
        return $country;
    }
    public function getGovernorateById($id){
        $governorate = Governorate::find($id);
        return $governorate;
    }

    public function changeStatus($country){
       $country =  $country->update([
            'is_active' => $country->is_active == 'Active' || $country->is_active == 'مفعل'  ? 0 : 1 ,
        ]);
       
        return $country;

    }
    public function changeGovStatus($governorate){
        $governorate = $governorate->update([
            'is_active' => $governorate->is_active == 'Active' || $governorate->is_active == 'مفعل' ? 0 : 1 ,
        ]);
        return $governorate;
    }

    public function changeShippingPrice($governorate , $price){
        return $governorate->shippingPrice->update([
            'price' => $price,
        ]);
    }

}
