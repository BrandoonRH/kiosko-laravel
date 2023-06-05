<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 //Lo que este dentro de aquí debe de estar autenticado

Route::middleware('auth:sanctum')->group(function() {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']); 

        //Save Orders 
        Route::apiResource('/orders', OrderController::class); 
        Route::apiResource('/categories', CategoryController::class); 
        Route::apiResource('/products', ProductController::class);  
        Route::get('/products-out', [ProductController::class, 'productsOut']);
        Route::get('/orders-out', [OrderController::class, 'ordersOut']);
       
});


//Auth 
Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login']); 