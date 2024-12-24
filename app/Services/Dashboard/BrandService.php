<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BrandRepository;
use App\Utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class BrandService
{
    protected $brandRepository , $imageManger;
    public function __construct(BrandRepository $brandRepository , ImageManger $imageManger)
    {
        $this->brandRepository = $brandRepository;
        $this->imageManger = $imageManger;
    }

    public function getBrand($id){
        $brand = $this->brandRepository->getBrand($id);
        if(!$brand){
            abort(404);
        }
            return $brand;

        
    }

    public function getBrandsForDatatables(){
        $brands = $this->brandRepository->getBrands();
        return DataTables::of($brands)
        ->addIndexColumn()
        ->addColumn('status' , function($brand){
            return $brand->getStatus();
        })
        ->addColumn('name' , function($brand){
            return $brand->getTranslation('name' , app()->getLocale());
        })
        ->addColumn('logo' , function($brand){
            return view('dashboard.brands.datatables.logo' , compact('brand'));
        })
        ->addColumn('products_count' , function($brand){
            return $brand->products_count == 0 ? __('dashboard.not_found')  :  $brand->products_count ;
        })
        ->addColumn('action' , function($brand){
            return view('dashboard.brands.datatables.actions' , compact('brand'));
        })
        ->rawColumns(['logo' , 'action'])
        ->make(true);

    }

    public function createBrand($data)
    {
        if($data['logo'] != null){
            $file_name = $this->imageManger->uploadSingleImage('/' , $data['logo'] , 'brands');
            $data['logo'] = $file_name;
        }
        $this->brandCache();
        return $this->brandRepository->createBrand($data);
    }

    public function updateBrand($id , $data){

     
        $brand = $this->getBrand($id) ;
            if(isset($data['logo'])){
                //delete old logo

                $this->imageManger->deleteImageFromLocal($brand->logo);
                $file_name = $this->imageManger->uploadSingleImage('/' , $data['logo'] , 'brands');
                $data['logo'] = $file_name;
            }

        return $this->brandRepository->updateBrand($brand , $data);
    }

    public function deleteBrand($id){
        $brand = $this->getBrand($id);
        $this->imageManger->deleteImageFromLocal($brand->logo);
        $brand =  $this->brandRepository->deleteBrand($brand);
        $this->brandCache();
        return $brand;

    }

    public function brandCache(){
        Cache::forget('brand_count');
    }
}