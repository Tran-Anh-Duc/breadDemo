<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TemplateController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/login',[AuthController::class,'login']);


Route::prefix('product')->group(function () {
    Route::post('/', [ProductController::class, 'getAllProduct']);
    Route::post('/create_product', [ProductController::class, 'create_product']);
    Route::post('/find_one/{id}', [ProductController::class, 'find_one']);
    Route::post('/update_product/{id}', [ProductController::class, 'update_product']);
    Route::post('/update_status/{id}', [ProductController::class, 'updateStatus']);
    Route::post('/add_to_card/{id}', [TemplateController::class, 'add_to_card']);
    Route::post('/searchLike', [TemplateController::class, 'searchLikeProduct']);
});

Route::prefix('category')->group(function () {
    Route::post('/', [CategoryController::class, 'listCategory']);
    Route::post('/create_category', [CategoryController::class, 'create_category']);
    Route::post('/detail_category/{id}', [CategoryController::class, 'find_one']);
    Route::post('/update_category/{id}', [CategoryController::class, 'update_category']);
    Route::post('/update_status/{id}', [CategoryController::class, 'updateStatus']);
});

Route::prefix('store')->group(function () {
    Route::post('/', [StoreController::class, 'getAllStore']);
    Route::post('/create_store', [StoreController::class, 'create_store']);
    Route::post('/detail_store/{id}', [StoreController::class, 'find_one_store']);
    Route::post('/update_store/{id}', [StoreController::class, 'update_store']);
    Route::post('/update_status/{id}', [StoreController::class, 'updateStatus']);
});

Route::prefix('news')->group(function () {
    Route::post('/', [StoreController::class, 'getAllNews']);
    Route::post('/create_news', [NewsController::class, 'create_news']);
    Route::post('/update_news/{id}', [NewsController::class, 'update_news']);
    Route::post('/update_status/{id}', [NewsController::class, 'update_status']);
    Route::post('/findOneNews/{id}', [NewsController::class, 'findOneNews']);
});





