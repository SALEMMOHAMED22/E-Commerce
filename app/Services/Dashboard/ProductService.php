<?php

namespace App\Services\Dashboard;

use App\Utils\ImageManger;
use App\Repositories\Dashboard\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ProductService
{

    protected $productRepository , $imageManager;
    public function __construct(ProductRepository $productRepository, ImageManger $imageManager)
    {
        $this->productRepository = $productRepository;
        $this->imageManager = $imageManager;
    }

public function createProductWithDetails($product , $productVariants , $images){
        $product = $this->productRepository->createProduct($product);

        // create product variants
        foreach($productVariants as $variant){
            $variant['product_id'] = $product->id;
            $productVariant = $this->productRepository->createProductVariant($variant);

            // create product variant attributes
            foreach($variant['attribute_value_ids'] as $attributeValueId){
                $this->productRepository->createProductVariantAttribute([
                    'product_variant_id' => $productVariant->id,
                    'attribute_value_id' => $attributeValueId,
                ]);
            }
            
            
            // create product images 
        }
        $this->imageManager->uploadImages($images , $product , 'products');

}

// public function updateProductWithDetails($product , $productData , $productVariants , $images){
//       try {
//         DB::beginTransaction();
//           // update simple product 
//          $productStatus =  $this->productRepository->updateProduct($product , $productData);
//           if(!$productStatus){
//             return false;
//           }
//          // delete old variants 
//            $this->productRepository->deleteProductVariants($product->id);
  
//           // create product variants
//           foreach($productVariants as $variant){
//               $productVariant = $this->productRepository->createProductVariant($variant);
//               if(!$productVariant){
//                 return false;
//               }
//               // create product variant attributes
//               foreach($variant['attribute_value_ids'] as $attributeValueId){
//                  $variantAttribute =  $this->productRepository->createProductVariantAttribute([
//                       'product_variant_id' => $productVariant->id,
//                       'attribute_value_id' => $attributeValueId,
//                   ]);
                  
//                   if(!$variantAttribute){
//                     return false;
//                   }
//               }
              
//           }
          


//           // create product images 
//           $this->imageManager->uploadImages($images , $product , 'products');
//           DB::commit();
//           return true;
//       } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error('Update Products With Details Error'.$e->getMessage());
//         return false;
//       }

// }

public function updateProductWithDetails($product , $productData , $productVariant , $images)
    {
        try {
            DB::beginTransaction();
             // update Product simple
            $productStatus = $this->productRepository->updateProduct($product,$productData);
            if(! $productStatus){
                return false;
            }
            // delete old Variants
            $this->productRepository->deleteProductVariants($product->id);

        // update Product new Variant 
        foreach($productVariant as $variant){
            $productVariant = $this->productRepository->createProductVariant($variant);
            if(! $productVariant){
                return false;
            }
            // create Variant Attributes
            foreach($variant['attribute_value_ids'] as $attribute_value_id){
                $variantAttribute = $this->productRepository->createVariantAttribute([
                    'product_variant_id' => $productVariant->id,
                    'attribute_value_id' => $attribute_value_id,
                ]);
                if(! $variantAttribute){
                    return false;
                }
            }
        } 

        // create Product Images
        // $this->image->uploadImages($images , $product , 'products');

            if (is_array($images) || is_object($images)) {
                $this->imageManager->uploadImages($images, $product, 'products');
            }
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('update product with details error' . $e->getMessage());
            return false;
        }

    }


public function getAttributes(){
    return $this->productRepository->getAttributes();
}

public function getProductsWithEgarLoading($id){
    $products =  $this->productRepository->getProductsWithEgarLoading($id);
    return  $products ?? abort(404);

}


public function getProductsForDatatable()
{
    $products = $this->productRepository->getProducts();
    return DataTables::of($products)

        ->addIndexColumn()
        ->addColumn('name' , function($row){
            return $row->getTranslation('name' , app()->getLocale());
        })
        ->addColumn('has_variants' , function($row){
            return $row->hasVariantsTranslated();
        })
        ->addColumn('images', function($row){
            return view('dashboard.products.datatables.images' , compact('row'));
        })
        ->addColumn('status' , function($row){
            return $row->getStatusTranslated();
        })
        ->addColumn('category' , function($row){
            return $row->category->name;
        })
        ->addColumn('brand' , function($row){
            return $row->brand->name;

        })
        ->addColumn('price' , function($row){
            return $row->priceAttribute();
        })
        ->addColumn('quantity' , function($row){
            return $row->quantityAttribute();
        })
        ->addColumn('action', function ($row) {
            return view('dashboard.products.datatables.actions' , compact('row'));
        })

        ->make(true);
}
public function getProductById($id){
    return $this->productRepository->getProductById($id);
}

public function changeStatus($id){
    $product = $this->getProductById($id);

    $product->status == 1 ? $status = 0 : $status = 1;

    $this->productRepository->changeStatus($product , $status);

    return $product;
    
   
}
public function deleteProduct($id){
    $product = $this->getProductById($id);
    $this->productRepository->deleteProduct($product);
    return $product;
}

public function deleteProductImage($imageId , $file_name){
     
    ImageManger::deleteImageFromLocal('uploads/products/'. $file_name );

    return $this->productRepository->deleteProductImage($imageId);
    

}



}


