<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TableController;
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
    Route::post('/getAllDataProductStore', [ProductController::class, 'getAllDataProductStore']);
    Route::post('/createProductAndStore', [ProductController::class, 'createProductAndStore']);
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
    Route::post('/createProductAndStore/{storeId}', [StoreController::class, 'createProductAndStore']);
});

Route::prefix('news')->group(function () {
    Route::post('/', [StoreController::class, 'getAllNews']);
    Route::post('/create_news', [NewsController::class, 'create_news']);
    Route::post('/update_news/{id}', [NewsController::class, 'update_news']);
    Route::post('/update_status/{id}', [NewsController::class, 'update_status']);
    Route::post('/findOneNews/{id}', [NewsController::class, 'findOneNews']);
    Route::post('/uploadImage', [NewsController::class, 'uploadImage']);
});


Route::prefix('table')->group(function () {
    Route::post('/', [TableController::class, 'getDataTable']);
    Route::post('/createTable', [TableController::class, 'createTable']);
//    Route::post('/update_news/{id}', [NewsController::class, 'update_news']);
    Route::post('/update_status/{id}', [TableController::class, 'update_status']);
    Route::post('/find_one_table/{id}', [TableController::class, 'find_one_table']);
//    Route::post('/uploadImage', [NewsController::class, 'uploadImage']);
    Route::post('/updateStatusOrder/{id}', [TableController::class, 'updateStatusOrder']);
});


Route::prefix('warehouses')->group(function () {
    Route::post('/',[\App\Http\Controllers\WarehouseController::class,'test']);
    Route::post('/createWarehouse',[\App\Http\Controllers\WarehouseController::class,'createWarehouse']);
});

Route::prefix('bill')->group(function(){
    Route::post('/creteBill',[\App\Http\Controllers\BillController::class,'create_bill_product']);
    Route::post('/show_bill',[\App\Http\Controllers\BillController::class,'show_bill']);
});



Route::post('/test1/{storeId}', [StoreController::class, 'test1']);
Route::post('/test2', [StoreController::class, 'test2']);
Route::post('/test', [ProductController::class, 'test1']);

