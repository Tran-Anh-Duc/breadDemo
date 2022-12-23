<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('bread')->group(function () {
    Route::get('/list_product', [TemplateController::class, 'allProduct']);
});

Route::prefix('product')->group(function () {
    Route::get('/list', [ProductController::class, 'allDataProduct'])->name('product.list_product');
    Route::get('/create_product', [ProductController::class, 'viewProduct'])->name('product.create_product_view');
    Route::post('/create', [ProductController::class, 'create_product'])->name('product.create_product');
    Route::get('/detail_product/{id}', [ProductController::class, 'find_one'])->name('product.detail_product');
    Route::post('/update_product/{id}', [ProductController::class, 'update_product'])->name('product.update_product');
});

Route::prefix('category')->group(function () {
    Route::get('/list', [CategoryController::class, 'listCategory'])->name('category.list_category');
    Route::get('/create_category', [CategoryController::class, 'view_create_category'])->name('category.create_category_view');
    Route::post('/create', [CategoryController::class, 'create_category'])->name('category.create_category');

});


