<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});
Route::prefix('product')->group(function () {
    Route::post('/', [ProductController::class, 'getAllProduct']);
    Route::post('/create_product', [ProductController::class, 'create_product']);
    Route::post('/find_one/{id}', [ProductController::class, 'find_one']);
    Route::post('/update_product/{id}', [ProductController::class, 'update_product']);
});

Route::prefix('category')->group(function () {
    Route::post('/', [CategoryController::class, 'listCategory']);
    Route::post('/create_category', [CategoryController::class, 'create_category']);
    Route::post('/detail_category/{id}', [CategoryController::class, 'find_one']);
    Route::post('/update_category/{id}', [CategoryController::class, 'update_category']);
});





