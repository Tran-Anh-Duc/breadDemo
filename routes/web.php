<?php

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
    Route::get('/list', [ProductController::class, 'allDataProduct']);
    Route::get('/create_product', [ProductController::class, 'viewProduct'])->name('product.create_product_view');
    Route::post('/create', [ProductController::class, 'create_product'])->name('product.create_product');
});


