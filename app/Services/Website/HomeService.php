<?php

namespace App\Services\Website;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class HomeService
{
    protected $productService ; 
    public function __construct(ProductService $productService)
    {
            $this->productService = $productService;
    }
    public function getSliders(){
        return Slider::get();
    }

    public function getCategories($limit = null){
        if($limit == null){
            return Category::active()->get();
        }
        return Category::active()->limit($limit)->get();
    }


    public function getBrands($limit = null){
        if($limit == null){
            return Brand::active()->get();
        }
        return Brand::active()->limit($limit)->get();
    }

    public function getProductsByBrand($slug){

        $brand_id = Brand::where('slug' , $slug)->first()->id;

        return Product::with('images' , 'brand' , 'category')
        ->latest()
        ->active()
        ->select('id' , 'name' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id')
        ->where('brand_id' , $brand_id)
        ->paginate(4);
    }
    public function getProductsByCategory($slug){

        $category_id = Category::where('slug' , $slug)->first()->id;

        return Product::with('images' , 'brand' , 'category')
        ->latest()
        ->active()
        ->select('id' , 'name' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id')
        ->where('category_id' , $category_id)
        ->paginate(4);
    }

    public function homePageProducts($limit = null): array{
        return [
            'new_arrivals' => $this->productService->newArrivalsProducts($limit),
            'flash_products' => $this->productService->getFlashProducts($limit),
            'flash_products_timer' => $this->productService->getFalshProductsWithTimer($limit),
        ];
    }
}
