<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\dashboard\BrandController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\WorldController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Can;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
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
            Route::resource('categories' , CategoryController::class)->except('show');
            Route::get('categories-all' , [CategoryController::class , 'getAll'])
            ->name('categories.all');
        // });
        ######################### Categories End #################################

        ######################### Brands Start #################################
        // Route::group(['middleware' => 'can:brands'] , function(){
            Route::resource('brands' , BrandController::class)->except('show');
            Route::get('brands-all' , [BrandController::class , 'getAll'] )->name('brands.all');
        // });
        ######################### Brands End #################################
        ######################### coupons Start #################################
        // Route::group(['middleware' => 'can:coupons'] , function(){
            Route::resource('coupons' , CouponController::class)->except('show');
            Route::get('coupons-all' , [CouponController::class , 'getAll'] )->name('coupons.all');
        // });
        ######################### coupons End #################################

    }
);
