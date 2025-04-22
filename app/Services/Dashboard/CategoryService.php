<?php

namespace App\Services\Dashboard;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\CategoryRepository;
use App\Utils\ImageManger;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    protected $categoryRepository , $imageManger;
    public function __construct(CategoryRepository $categoryRepository , ImageManger $imageManger)
    {
         $this->categoryRepository = $categoryRepository;
         $this->imageManger = $imageManger;
    }

    public function findById($id){
         return $this->categoryRepository->findById($id);
    }
    public function getCategories(){
        $categories = $this->categoryRepository->getAll();
        return $categories;
    }

    public function getCategoriesForDatatable(){
        $categories = $this->categoryRepository->getAll();

        return DataTables::of($categories)
        ->addIndexColumn()
        ->addColumn('name' , function($category){
            return $category->getTranslation('name' , app()->getLocale());
        })
        ->addColumn('status' , function($category){
            return $category->getStatusTranslated();
        })
        ->addColumn('products_count' , function($category){
            return $category->products()->count() == 0 ? __('dashboard.not_found')  :  $category->products()->count() ;
        })
         ->addColumn('icon' , function($category){
            return view('dashboard.categories.icons' , compact('category'));
        })
         ->addColumn('action' , function($category){
            return view('dashboard.categories.actions' , compact('category'));
        })
        ->make(true);
    }

    public function store($data){
      if(array_key_exists('icon' , $data) && $data['icon'] != null){
          $file_name = $this->imageManger->uploadSingleImage('/' , $data['icon'] , 'categories');
          $data['icon'] = $file_name;
      }
        return $this->categoryRepository->store($data);
    } 

    public function update($data){
        $category = $this->categoryRepository->findById($data['id']);
        if(array_key_exists('icon' , $data) && $data['icon'] != null){
            //delete old logo
            $this->imageManger->deleteImageFromLocal($category->icon);
            $file_name = $this->imageManger->uploadSingleImage('/' , $data['icon'] , 'categories');
            $data['icon'] = $file_name;
        }
        if(!$category){
            return false;
        }
        $category = $this->categoryRepository->update($category , $data);
        return $category;
    }
    public function delete($id){

        $category = $this->categoryRepository->findById($id);
        return $this->categoryRepository->delete($category);
    }


    public function getParentCategories(){
        return $this->categoryRepository->getParentCategories();
    }


    public function getCategoriesExceptChildren($id){

        return $this->categoryRepository->getCategoriesExceptChildren($id);
    }
} 
