<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        //
    }

   
    public function boot(): void
    {

        view()->composer('dashboard.*', function ($view) {
            if (!Cache::has('category_count')) {
                Cache::remember('category_count', now()->addMinutes(60), function () {
                    return Category::count();
                });
            }
            if (!Cache::has('faqs_count')) {
                Cache::remember('faqs_count', now()->addMinutes(60), function () {
                    return Faq::count();
                });
            }
            if (!Cache::has('coupon_count')) {
                Cache::remember('coupon_count', now()->addMinutes(60), function () {
                    return Coupon::count();
                });
            }
            if (!Cache::has('brand_count')) {
                Cache::remember('brand_count', now()->addMinutes(60), function () {
                    return Brand::count();
                });
            }
            if (!Cache::has('admin_count')) {
                Cache::remember('admin_count', now()->addMinutes(60), function () {
                    return Admin::count();
                });
            }

            view()->share([
                'category_count' => Cache::get('category_count'),
                'brand_count' => Cache::get('brand_count'),
                'admin_count' => Cache::get('admin_count'),
                'coupon_count' => Cache::get('coupon_count'),
                'faqs_count' => Cache::get('faqs_count'),

            ]);
        });

        // get Setting And Share
        $setting = $this->firstOrCreateSetting();

        view()->share([
            'setting' => $setting,
        ]);
    }
    


    public function firstOrCreateSetting()
    {
        $getSetting = Setting::firstOr(function () {
            return Setting::create([
                'site_name' => [
                    'ar' => 'متجر الكتروني',
                    'en' => 'E-Commerce',
                ],
                'site_desc' => [
                    'en' => 'This is E-Commerce website',
                    'ar' => 'هذا موقع متجر الكتروني ',
                ],
                'site_address' => [
                    'en' => 'Egypt , Cairo , shoubra',
                    'ar' => 'مصر , القاهرة,  شبرا',
                ],
                'site_phone' => '01019907979',
                'site_email' => 'e-commerce@gmail.com',
                'email_support' => 'e-commerceSupport@gmail.com',

                // socail
                'facebook_url' => 'https://www.facebook.com/',
                'twitter_url' => 'https://www.twitter.com/',
                'youtube_url' => 'https://www.youtube.com/',

                'logo' => 'logo.png',
                'favicon' => 'logo.png',
                'site_copyright' => '©2025 Your E-commerce Name. All rights reserved.',

                'meta_description' => [
                    'en' => '23 of PARAGE is equality of condition, blood, or dignity; specifically',
                    'ar' => '23 of PARAGE is equality of condition, blood, or dignity; specifically ',
                ],
                'promotion_video_url' => 'https://www.youtube.com/embed/SsE5U7ta9Lw?rel=0&amp;controls=0&amp;showinfo=0',

            ]);
        });
        return $getSetting;
    }
}



    
