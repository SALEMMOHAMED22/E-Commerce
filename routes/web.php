<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
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
        });
        ############################ End Auth ################################
        Route::get('/home', [HomeController::class, 'index'])->name('website.home');
    }
);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
