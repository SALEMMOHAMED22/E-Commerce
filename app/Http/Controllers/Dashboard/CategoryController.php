<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Dashboard\CategoryService;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        return $this->categoryService = $categoryService;
    }
    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function getAll(){
        $categories = $this->categoryService->getCategoriesForDatatable();
        return $categories;
      
    }

    public function create() 
    {
        $categories = $this->categoryService->getParentCategories();
        return view('dashboard.categories.create' , compact('categories'));
    }

   
    public function store(CategoryRequest $request)
    {
        $data = $request->only(['name' , 'parent' ,'status' ,'icon']);
        if(!$this->categoryService->store($data)){
            Session::flash('error' , __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , __('dashboard.success_msg'));
        return redirect()->back();
    }


   
    public function edit(string $id)
    {
        $category = $this->categoryService->findById($id);
        $categories = $this->categoryService->getCategoriesExceptChildren($id);
        return view('dashboard.categories.edit' , compact('categories' , 'category'));
    }

    
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->only(['name' , 'parent' ,'status' , 'id' , 'icon']);
        if(!$this->categoryService->update($data)){
            Session::flash('error' , __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , __('dashboard.success_msg'));
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        if(!$this->categoryService->delete($id)){
            Session::flash('error' , __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , __('dashboard.success_msg'));
        return redirect()->back();
    }
}
