<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\ProductService;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    protected $ProductService ;

    public function __construct(ProductService $product_service)
    {
        $this->ProductService = $product_service;
    }

    public function showProductPage($slug){
        $product = $this->ProductService->getProductBySlug($slug);
        if(!$product){
            abort(404);
        }

        return view('website.show' , compact('product'));
    }

    public function getProductsByType($type){
       if($type == 'new-arrivals'){
        $products = $this->ProductService->newArrivalsProducts();
       }elseif($type == 'flash-products'){
        $products = $this->ProductService->getFlashProducts();
       }elseif($type == 'flash-products-timer'){
        $products = $this->ProductService->getFalshProductsWithTimer();

       }else{
        abort(404);
       }

       return view('website.products' , [
        'products' => $products,
        'flash_timer' => $type == 'flash-products-timer' ? true : false,
       ]);
    }
}
