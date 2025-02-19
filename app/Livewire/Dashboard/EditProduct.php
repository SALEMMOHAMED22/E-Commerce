<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\Dashboard\ProductService;

class EditProduct extends Component
{
    use WithFileUploads;

    public $successMessage = '' , $currentStep = 1;
    // first step properties
    public $name_ar , $name_en , $small_desc_ar , $small_desc_en , $desc_ar , $desc_en , $category_id , $brand_id  , $sku , $available_for ;
    // second step properties
    public $has_variants , $price , $quantity , $manage_stock , $has_discount , $discount , $start_discount ,$end_discount ;
    public $prices , $quantities , $variants , $variantAttributes = [] , $valueRowCount = 0; 
    // third step properties
    public $images, $newImages ;
    protected ProductService $productService;
    public $product;
    public $productId , $categories , $brands , $productAttributes = [];

    
    public function boot(ProductService $productService){
       return $this->productService = $productService;
    } 
     
    public function mount($productId , $categories , $brands , $productAttributes)  
    {
        // $this->product = Product::with('variants.VariantAttributes')->find($productId);
        $this->product =  $this->productService->getProductsWithEgarLoading($productId);
        $this->categories = $categories;
        $this->brands = $brands;
        $this->productAttributes = $productAttributes;
        $this->images = $this->product->images;

        // first step properties

        $this->name_ar = $this->product->getTranslation('name' , 'ar');
        $this->name_en = $this->product->getTranslation('name' , 'en');
        $this->small_desc_ar = $this->product->getTranslation('small_desc' , 'ar');
        $this->small_desc_en = $this->product->getTranslation('small_desc' , 'en');
        $this->desc_ar = $this->product->getTranslation('desc' , 'ar'); 
        $this->desc_en = $this->product->getTranslation('desc' , 'en');
        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;
        $this->sku = $this->product->sku;
        $this->available_for = $this->product->available_for;

        // second step properties 

        $this->has_variants = $this->product->has_variants;
        $this->manage_stock = $this->product->manage_stock;
        $this->quantity = $this->product->quantity;
        $this->has_discount = $this->product->has_discount;
        $this->price = $this->product->price;
        $this->discount = $this->product->discount;
        $this->start_discount = $this->product->start_discount;
        $this->end_discount = $this->product->end_discount;

        if($this->has_variants == 1){
            $this->variants = $this->product->variants;
            $this->valueRowCount = count($this->variants);
            foreach($this->variants as $key => $variant){
                $this->prices[$key] = $variant->price;
                $this->quantities[$key] = $variant->stock;
                foreach ($variant->variantAttributes as $variantAttribute) {
                    $this->variantAttributes[$key][$variantAttribute->attributeValue->attribute_id] = $variantAttribute->attribute_value_id;
                }
            }
        }
        

    


    }

    public function firstStepSubmit()
    {
        // validate => first step
        $this->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'small_desc_ar' => 'required|string',
            'small_desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'desc_en' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'required|string',
            'available_for' => 'required|string',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit(){

        $data = [
            'has_variants' => ['required', 'in:0,1'],
            'manage_stock' => ['required', 'in:0,1'],
            'has_discount' => ['required', 'in:0,1'],
        ];

        if($this->has_variants == 0){
            $data['price'] = ['required', 'numeric', 'min:1' , 'max:999999'];
        }
        if($this->manage_stock == 1 && $this->has_variants == 0){
            $data['quantity'] = ['required', 'numeric', 'min:1' , 'max:999999'];
        }
        if($this->has_discount == 1){
            $data['discount'] = ['required', 'numeric', 'min:1' , 'max:100'];
            $data['start_discount'] = ['required', 'before:end_discount'];
            $data['end_discount'] = ['required', 'after:start_discount'];
        }
        if($this->has_variants == 1){
            $data['prices'] = ['required', 'array'];
            $data['prices.*'] = ['required', 'numeric', 'min:1' , 'max:999999'];
            $data['quantities'] = ['required', 'array'];
            $data['quantities.*'] = ['required', 'numeric', 'min:1' , 'max:999999'];
            $data['variantAttributes'] = ['required', 'array' , 'min:1'];
            $data['variantAttributes.*'] = ['required', 'array'];
            $data['variantAttributes.*.*'] = 'required|integer|exists:attribute_values,id';
        }

        $this->validate($data);
        $this->currentStep = 3;
    }

    public function submitForm(){
        $productData = [
            'name' => ['ar' => $this->name_ar, 'en' => $this->name_en],
            'desc' =>['ar' => $this->desc_ar, 'en' => $this->desc_en],
            'small_desc' => ['ar' => $this->small_desc_ar, 'en' => $this->small_desc_en],
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'available_for' => $this->available_for,
            'sku' => $this->sku,
            'has_variants' =>  $this->has_variants,
            'manage_stock' => $this->has_variants == 1? 1 :  $this->manage_stock,
            'has_discount' => $this->has_discount,
            'price' => $this->has_variants == 1 ? null :  $this->price,
            'quantity' => $this->manage_stock == 0 ? null :  $this->quantity,
            'discount' => $this->has_discount == 0 ? null : $this->discount,
            'start_discount' => $this->has_discount == 0 ? null : $this->start_discount,
            'end_discount' =>$this->has_discount == 0 ? null :  $this->end_discount,
        ];

      

        
        // store variants
        $productVariants = [];
        if($this->has_variants){
            foreach($this->prices as $index => $price){
                $productVariants[] = [
                    'product_id' => $this->product->id,
                    'price' => $price,
                    'stock' => $this->quantities[$index] ?? 0 ,
                    'attribute_value_ids' => $this->variantAttributes[$index],
                    
                ];
               
            }
        }
        $this->productService->updateProductWithDetails( $this->product ,$productData , $productVariants , $this->newImages);
        $this->successMessage = __('dashboard.success_msg');
        // $this->resetExcept(['successMessage' , 'categories' , 'brands']);

        $this->currentStep = 1;


    }

    public function back($step){
         $this->currentStep = $step;
    }

    public function addNewVariant()
    {
        $this->prices[] = null;
        $this->quantities[] = null;
        $this->variantAttributes[] = [];
        $this->valueRowCount = count($this->prices); // Keep count synchronized
    }

    public function removeVariant($index){

        if($this->valueRowCount > 1 ){
            unset($this->prices[$index]);
            unset($this->quantities[$index]);
            unset($this->variantAttributes[$index]);


        // إعادة ترتيب المصفوفات بعد الحذف
        $this->prices = array_values($this->prices);
        $this->quantities = array_values($this->quantities);
        $this->variantAttributes = array_values($this->variantAttributes);

         $this->valueRowCount--;
        }
       }
    
    public function deleteImage($imageId ,$index , $file_name){
        $this->productService->deleteProductImage($imageId , $file_name);

        unset($this->images[$index]);
    }

    public function deleteNewImage($key){
        unset($this->newImages[$key]);
    }


    public function render()
    {
        return view('livewire.dashboard.edit-product');

    }
}


