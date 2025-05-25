<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Website\FaqController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Website\AboutUsController;
use App\Http\Controllers\Website\BrandController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\DynamicPageController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\WishlistController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'website.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ############################ Auth ################################
        Route::controller(RegisterController::class)->group(function () {
            Route::get('register', 'showRegistrationForm')->name('register.get');
            Route::post('register', 'register')->name('register.post');
        });
        Route::controller(LoginController::class)->group(function () {
            Route::get('login', 'showLoginForm')->name('login.get');
            Route::post('login', 'login')->name('login.post');
            Route::post('logout', 'logout')->name('logout.post');
        });
        ############################ End Auth ################################
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        // Route::get('/about-us' , [AboutUsController::class , 'showAboutUsPage'])->name('about-us');
        Route::get('page/{slug}', [DynamicPageController::class, 'showDynamicPage'])->name('dynamic.page');
        Route::get('faqs', [FaqController::class, 'showFaqsPage'])->name('faqs.index');

        Route::prefix('brands')->name('brands.')->controller(BrandController::class)->group(function () {
            Route::get('/',                  'index')->name('index');
            Route::get('/{slug}/products',   'showProductsByBrand')->name('products');
        });
        Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
            Route::get('/categories',                  'index')->name('index');
            Route::get('categories/{slug}/products',   'showProductsByCategory')->name('products');
        });

        Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
            Route::get('/show/{slug}', 'showProductPage')->name('show');
            Route::get('/{type}',  'getProductsByType')->name('by.type');

            Route::get('/{slug}/related-products ', 'getRelatedProductsBySlug')->name('related');
        });
        Route::get('/shop', [HomeController::class, 'showShopPage'])->name('shop');
        Route::group(['middleware' => 'auth:web'], function () {
            
            ############################ Profile Routes ################################
            Route::controller(ProfileController::class)->group(function () {
                Route::get('user-profile', 'showProfile')->name('profile');
            });
            ############################ End Profile Routes ############################
            ############################ wishlist Routes ################################
            Route::get('/wishlist' , WishlistController::class)->name('wishlist');
            ############################ ُEnd wishlist Routes ################################
            ############################ ُCart Routes ################################
            Route::get('/cart' , [CartController::class , 'showCartPage'])->name('cart');
            ############################ ُEnd Cart Routes ################################

        });
    }
);

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
