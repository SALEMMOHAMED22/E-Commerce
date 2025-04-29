<?php

use Livewire\Livewire;
use Illuminate\Validation\Rules\Can;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\Dashboard\{
    FaqController,
    RoleController,
    AdminController,
    BrandController,
    WorldController,
    CouponController,
    ProductController,
    SettingController,
    WelcomeController,
    CategoryController,
    AttributeController,
    ContactController,
    FaqQuestionController,
    PageController,
    SliderController,
    UserController,
};
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        ############################ Auth ################################

        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        ############################ Reset Password ################################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(ForgetPasswordController::class)->group(function () {

                Route::get('email', 'showEmailForm')->name('email');
                Route::post('email', 'sendOtp')->name('email.post');
                Route::get('verify/{email}', 'showOtpForm')->name('verify');
                Route::post('verify', 'verifyOtp')->name('verify.post');
            });
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email}', 'showresetForm')->name('reset');
                Route::post('reset', 'resetPassword')->name('reset.post');
            });
        });
        ############################ End Password ################################

        ############################ protected routes ################################
        Route::group(['middleware' => 'auth:admin'], function () {

            ############################ welcome routes ################################

            Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
        });

        ############################ Roles routes ################################
        //   Route::group(['middleware' => 'can:roles'] , function(){


        Route::resource('roles', RoleController::class);
        // });

        Route::resource('admins', AdminController::class);
        Route::get('admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.changeStatus');

        ######################### Shipping Start #################################
        Route::controller(WorldController::class)->group(function () {

            Route::prefix('countries')->name('countries.')->group(function () {
                Route::get('/', 'getAllCountries')->name('index');
                Route::get('{country_id}/governorate', 'getAllGovernoratesByCountryId')->name('governorates.index');
                Route::get('{gov_id}/cities', 'getAllCitiesByGovernorateId')->name('citties.index');
                Route::get('change-status/{country_id}', 'changeStatus')->name('status');
            });

            Route::prefix('governorates')->name('governorates.')->group(function () {
                Route::get('change-status/{gov_id}', 'changeGovStatus')->name('status');
                Route::put('shipping-price', 'changeShippingPrice')->name('shipping-price');
            });
        });
        ######################### Shipping End #################################

        ######################### Categories Start #################################
        // Route::group(['middleware' => 'Can:categories'] , function(){
        Route::resource('categories', CategoryController::class)->except('show');
        Route::get('categories-all', [CategoryController::class, 'getAll'])
            ->name('categories.all');
        // });
        ######################### Categories End #################################

        ######################### Brands Start #################################
        // Route::group(['middleware' => 'can:brands'] , function(){
        Route::resource('brands', BrandController::class)->except('show');
        Route::get('brands-all', [BrandController::class, 'getAll'])->name('brands.all');
        // });
        ######################### Brands End #################################

        ######################### coupons Start #################################
        // Route::group(['middleware' => 'can:coupons'] , function(){
        Route::resource('coupons', CouponController::class)->except('show');
        Route::get('coupons-all', [CouponController::class, 'getAll'])->name('coupons.all');
        // });
        ######################### coupons End #################################

        ######################### Faq Start #################################
        // Route::group(['middleware' => 'can:faqs'] , function(){
        Route::resource('faqs', FaqController::class);
        Route::get('faqs-all', [FaqController::class, 'getAll'])->name('faqs.all');
        // });
        ######################### Faq End #################################
        ######################### Faq Question Start #################################
        // Route::group(['middleware' => 'can:faqs'] , function(){
        Route::get('faq-questions' , [FaqQuestionController::class , 'index'])->name('faq.questions.index');
        Route::delete('faq-questions/{id}' , [FaqQuestionController::class , 'destroy'])->name('faq.questions.destroy');
        Route::get('faq-questions-all', [FaqQuestionController::class, 'getAll'])->name('faq.questions.all');
        // });
        ######################### Faq Question End #################################

        ######################### settings Start #################################
        // Route::group(['middleware' => 'can:settings'] , function(){
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings/{id}', [SettingController::class, 'update'])->name('settings.update');
        // });
        ######################### settings End #################################
        ######################### attribute Start #################################
        // Route::group(['middleware' => 'can:attribute'] , function(){
        Route::resource('attributes', AttributeController::class);
        Route::get('attributes-all', [AttributeController::class, 'getAll'])->name('attributes.all');
        // });
        ######################### attribute End #################################

        ######################### Products Routes #################################
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });


        // Route::group(['middleware' => 'can:products'], function () {
        Route::resource('products', ProductController::class);
        Route::get('products-all', [ProductController::class, 'getAll'])->name('products.all');
        Route::post('products/change-status', [ProductController::class, 'changeStatus'])->name('products.changeStatus');

        Route::get('product/variants/{variant_id}', [ProductController::class, 'deleteVariant'])->name('products.variants.delete');
        // });


        ######################### End Products  #################################


        ######################### users Start #################################
        // Route::group(['middleware' => 'Can:users'] , function(){
        Route::resource('users', UserController::class);
        Route::post('users/status', [UserController::class, 'changeStatus'])->name('users.status');
        Route::get('users-all', [UserController::class, 'getAll'])
            ->name('users.all');
        // });
        ######################### users End #################################
        ######################### contacts Start #################################
        // Route::group(['middleware' => 'Can:contact'] , function(){

        Route::get('contacts', [ContactController::class, 'index'])
            ->name('contacts.index');
        // });
        ######################### contacts End #################################

        ######################### Slider Start #################################
        // Route::group(['middleware' => 'can:sliders'], function () {
                Route::get('sliders' , [SliderController::class , 'index'])->name('sliders.index');
                Route::post('sliders' , [SliderController::class , 'store'])->name('sliders.store');
                Route::get('sliders-all' , [SliderController::class , 'getAll'])->name('sliders.all');
                Route::get('remove/{id}' , [SliderController::class , 'destroy'])->name('sliders.destroy');
        // });
        ######################### Slider End #################################

        ######################### Page Routes #################################
        // Route::group(['middleware' => 'can:pages'], function () {
           Route::resource('pages', PageController::class);
           Route::get('pages-all' , [PageController::class , 'getAll'])->name('pages.all'); 
        // });
        ######################### Page Routes #################################



    }
);
