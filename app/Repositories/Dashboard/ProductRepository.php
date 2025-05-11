<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;

class ProductRepository
{
  public function createProduct($data)
  {
    $product = Product::create($data);
    return $product;
  }

  public function createProductVariant($data)
  {
    return ProductVariant::create($data);
   
  }

  public function createVariantAttribute($data)
  {
    return VariantAttribute::create($data);
  }


  public function updateProduct($product ,$data){
    return $product->update($data);
  }

  public function getAttributes(){
    $attributes = Attribute::with('attributeValues')->get();
    return $attributes;
  }
  public function getProducts(){
    $products = Product::latest()->get();
    return $products;
  }
  public function getProductsWithEgarLoading($id){
    $products = Product::with('variants.VariantAttributes')->find($id);
    return $products;
  }

  public function getProductById($id){
    $product = Product::find($id);
    return $product ?? abort(404);
    
  }
  public function changeStatus($product , $status){
    $product->status = $status;
    $product->save();
    return $product;
  }
  public function deleteProduct($product){
    $product->delete();
    return $product;
  }

  public function deleteProductImage($imageId){

    return ProductImage::find($imageId)->delete();
    
  }

  public function deleteProductVariants($productId){
      return ProductVariant::where('product_id' , $productId)->delete();
  }
  
}
