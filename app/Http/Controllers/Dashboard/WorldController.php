<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingPriceRequest;
use App\Services\Dashboard\WorldService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WorldController extends Controller
{
    protected $worldService;
    public function __construct(WorldService $worldService)
    {
        $this->worldService = $worldService;
    }

    public function getAllCountries()
    {

        $countries = $this->worldService->getAllCountries();
        return view('dashboard.world.countries', compact('countries'));
    }

    public function getAllGovernoratesByCountryId($id)
    {
        $governorates = $this->worldService->getAllGovernorates($id);
        return view('dashboard.world.governorates', compact('governorates'));
    }
    public function getAllCitiesByGovernorateId($id)
    {
        $cities = $this->worldService->getAllCities($id);
        return view('dashboard.world.cities', compact('cities'));
    }
    public function changeStatus($country_id)
    {
        $country = $this->worldService->changeStatus($country_id);
        if (!$country) {

            return response()->json([
                'status' => false,
                'message' => 'country not found',
            ], 404);
        }

        $country = $this->worldService->getCountryById($country_id);
        return response()->json([
            'status' => 'success',
            'message' => 'status changed successfully',
            'data' => $country
        ], 200);
    }

    public function changeGovStatus($gov_id)
    {
        $governorate = $this->worldService->changeGovStatus($gov_id);
        if (!$governorate) {
            return response()->json([
                'status' => false,
                'message' => 'governorate not found',
            ], 404);
        }

        $governorate = $this->worldService->getGovernorateById($gov_id);
        return response()->json([
            'status' => 'success',
            'message' => 'status changed successfully',
            'data' => $governorate,
        ], 200);
    }

    // public function changeShippingPrice(ShippingPriceRequest $request)
    // {


    //     $price = $this->worldService->changeShippingPrice($request);
    //     if (!$price) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'something is error',

    //         ], 404);
    //     }
    //     $gov = $this->worldService->getGovernorateById($request->id);

    //     $gov->load('shippingPrice');
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'price changed successfully',
    //         'data' => $gov,

    //     ], 200);
    // }
    public function changeShippingPrice(shippingPriceRequest $request)
    {
        if (!$this->worldService->changeShippingPrice($request)) {
            return response()->json([
                'status' => false,
                'message' => __('dashboard.error_msg')
            ], 404);
        }

        $gov = $this->worldService->getGovernorateById($request->gov_id);

        $gov->load('shippingPrice');
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $gov
        ], 200);
    }
}
