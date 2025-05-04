<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Website\HomeService;

class CategoryController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(){
        $categories = $this->homeService->getCategories();
        return view('website.categories' , compact('categories'));
    }

    public function showProductsByCategory($slug){
        $products = $this->homeService->getProductsByCategory($slug);
        return view('website.products' , compact('products'));
    }
}
