<?php

namespace App\Http\Controllers\Website;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Website\HomeService;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $sliders = $this->homeService->getSliders();
        $someCategories = $this->homeService->getCategories(12);
        $someBrands = $this->homeService->getBrands(12);

        $homePageProducts = $this->homeService->homePageProducts(12);

        
        return view('website.index' , compact('sliders' , 'someCategories' , 'someBrands' , 'homePageProducts'));
    }

    public function showShopPage(){
        return view('website.shop');
    }
}
