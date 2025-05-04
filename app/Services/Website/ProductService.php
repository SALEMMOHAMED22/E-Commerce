<?php

namespace App\Services\Website;

use App\Models\Product;

class ProductService
{


    public function getProductBySlug($slug){
        return Product::with('images' , 'brand' , 'category')
        ->active()
        ->where('slug' , $slug)
        ->first();
    }

    public function newArrivalsProducts($limit = null){
        $products =  Product::with('images' , 'brand' , 'category')
        ->active()
        ->latest()
        ->select('id' , 'name' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id');
        
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }

    public function getFlashProducts($limit = null){
        $products = Product::with('images' , 'brand' , 'category')
        ->active()
        ->where('has_discount' , 1)
        ->latest()
        ->select('id' , 'name' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id');
        
        
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }

    public function getFalshProductsWithTimer($limit = null){
        $products = Product::with('images' , 'brand' , 'category')
        ->active()
        ->where('available_for' , date('Y-m-d'))->whereNotNull('available_for')
         ->where('has_discount' , 1)
        ->latest()
        ->select('id' , 'name' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id');
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }
}
