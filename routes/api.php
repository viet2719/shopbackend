<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FilesController;


Route::group([
    'middleware' => 'api',
], function () {
    Route::group(['prefix' => 'v1/auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/change-pass', [AuthController::class, 'changePassWord']);
    });

    Route::group(['prefix' => 'v1'], function () {
        Route::resource('products', ProductsController::class)->only('index','show','store','update','destroy');
        Route::resource('categories', CategoriesController::class)->only('index','show','store','update','destroy');
    });
});




