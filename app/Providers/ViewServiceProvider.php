<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        view()->composer('dashboard.*' , function($view){

        
        if(!Cache::has('category_count')){
            Cache::remember('category_count' , now()->addMinute(10) , function(){
                return Category::count();
            });
        }
        if(!Cache::has('brand_count')){
            Cache::remember('brand_count' , now()->addMinute(10) , function(){
                return Brand::count();
            });
        }
        if(!Cache::has('admin_count')){
            Cache::remember('admin_count' , now()->addMinute(10) , function(){
                return Admin::count();
            });
        }

        view()->share([
            'category_count' => Cache::get('category_count'),
            'brand_count' => Cache::get('brand_count'),
            'admin_count' => Cache::get('admin_count'),
        ]);

    });
    }
}
