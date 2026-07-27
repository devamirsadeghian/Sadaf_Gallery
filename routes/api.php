<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Base_url = http://127.0.0.1:8000/api/v1/...

// middleware('auth:sanctum')->
Route::prefix('/v1')->group(function (){
    Route::post('register',[\App\Http\Controllers\Api\V1\UserApiController::class,'register']);
    Route::post('profile',[\App\Http\Controllers\Api\V1\UserApiController::class,'profile'])->name('profile');

    Route::post('payment',[\App\Http\Controllers\Api\V1\PaymentController::class,'payment'])->name('payment');

    Route::post('save_product_comment',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'save_product_comment']);
    Route::post('received_orders',[\App\Http\Controllers\Api\V1\UserApiController::class,'received_orders'])->name('received_orders');
});


Route::prefix('/v1')->group(function (){
    Route::post('send_sms',[\App\Http\Controllers\Api\V1\AuthApiController::class,'send_sms']);
    Route::post('verify_sms',[\App\Http\Controllers\Api\V1\AuthApiController::class,'verify_sms']);

    Route::get('/home',[\App\Http\Controllers\Api\V1\HomeApiController::class,'home']);

    Route::get('/most_sold_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'most_sold_products']);
    Route::get('/most_viewed_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'most_viewed_products']);
    Route::get('/newest_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'newest_products']);
    Route::get('/cheapest_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'cheapest_products']);
    Route::get('/most_expensive_products',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'most_expensive_products']);
    Route::get('/biggest_discount',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'biggest_discount']);

    Route::get('/products_by_category/{id}',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'products_by_category']);
    Route::get('/products_by_brand/{id}',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'products_by_brand']);
    Route::get('/products_details/{id}',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'products_details']);
    Route::post('/search_product',[\App\Http\Controllers\Api\V1\ProductsApiController::class,'search_product']);

    Route::get('/call_back',[\App\Http\Controllers\Api\V1\PaymentController::class,'call_back']);


    // test api Resource
    Route::apiResource('tests', \App\Http\Controllers\Api\V1\TestController::class);
});

