<?php

namespace App\Services\Website;

use App\Models\Product;

class ProductService
{


    public function getProductBySlug($slug){
        return Product::with('images' , 'brand' , 'category' , 'productPreviews')

        ->select('id' , 'name' ,'desc', 'small_desc' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id')
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

    public function getRelatedProductsBySlug($slug , $limit = null ){

        $categroy_id = Product::where('slug' , $slug)->first()->category_id;
        $products =  Product::with('images' , 'brand' , 'category')
        ->select('id' , 'name' ,'slug' , 'price' , 'has_variants' , 'has_discount' ,'discount' ,'brand_id' , 'category_id')
        ->where('category_id' , $categroy_id)
        ->latest();
        
        if($limit){

            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }
}
