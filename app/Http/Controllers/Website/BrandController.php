<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(){
        $brands = $this->homeService->getBrands();
        return view('website.brands' , compact('brands'));
    }

    public function showProductsByBrand($slug){
        $products = $this->homeService->getProductsByBrand($slug);
        return view('website.products' , compact('products'));
    }
}
