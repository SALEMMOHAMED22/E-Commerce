<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\BrandService;
use App\Services\Dashboard\ProductService;
use App\Services\Dashboard\CategoryService;
use App\Services\Dashboard\AttributeService;

class ProductController extends Controller
{
    protected $productService , $categoryService , $brandService , $attributeService;
    public function __construct(ProductService $productService , CategoryService $categoryService , BrandService $brandService , AttributeService $attributeService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->attributeService = $attributeService;

    }
    public function index()
    {
        return view('dashboard.products.index' );
    }

    public function getAll(){
    return  $this->productService->getProductsForDatatable();
    }


    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('dashboard.products.create' , compact('brands' , 'categories'));
    }

  
    public function store(Request $request)
    {
        
    }

    
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);
        return view('dashboard.products.show' , compact('product'));
    }

   
    public function edit(string $id)
    {
        $productId = $id ; 
        $categories = $this->categoryService->getCategories();
        $brands = $this->brandService->getBrands();
        $attributes = $this->attributeService->getAttributes();

        return view('dashboard.products.edit' , compact('productId' , 'categories' , 'brands' , 'attributes'));

    }

    public function update(Request $request, string $id)
    {
        
    }


    public function destroy(string $id)
    {
        $product = $this->productService->deleteProduct($id);
        if($product){
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.product_deleted_successfully'),
                ] , 200);
        }else{
            return response()->json(['status' => 'error', 'message' => __('dashboard.product_delete_failed')] , 500);
        }
    }

    public function changeStatus(Request $request){
        $product = $this->productService->changeStatus($request->id);
        if($product){
            return response()->json(['status' => 'success', 'message' => __('dashboard.product_status_changed_successfully')]);
        }else{
            return response()->json(['status' => 'error', 'message' => __('dashboard.product_status_change_failed')]);
        }
    }

    public function deleteVariant(string $variant_id){
        $variant = ProductVariant::find($variant_id);
        $product = $variant->product;
        if($product->variants->count() == 1){
            return redirect()->back()->with('error', 'You can not delete the last variant');
        }
        $variant->delete();
        return redirect()->back()->with('success', 'Variant deleted successfully');
    }
}
