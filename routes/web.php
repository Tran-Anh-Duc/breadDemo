<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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
    Route::get('/view_card', [TemplateController::class, 'view_card'])->name('bread.card');
    Route::get('/add_to_card/{id}', [TemplateController::class, 'add_to_card'])->name('bread.add_to_card');
    Route::get('/updateCard', [TemplateController::class, 'updateCard'])->name('bread.updateCard');
    Route::get('/removeCard', [TemplateController::class, 'removeCard'])->name('bread.removeCard');
    Route::get('/view_register', [AuthController::class, 'viewRegister'])->name('bread.viewRegister');
    Route::get('/view_login', [AuthController::class, 'viewLogin'])->name('bread.viewLogin');
    Route::post('/register', [AuthController::class, 'register'])->name('bread.register');
    Route::post('/login', [AuthController::class, 'login'])->name('bread.login');
});

Route::prefix('product')->group(function () {
    Route::get('/list', [ProductController::class, 'allDataProduct'])->name('product.list_product');
    Route::get('/create_product', [ProductController::class, 'viewProduct'])->name('product.create_product_view');
    Route::post('/create', [ProductController::class, 'create_product'])->name('product.create_product');
    Route::get('/detail_product/{id}', [ProductController::class, 'find_one'])->name('product.detail_product');
    Route::post('/update_product/{id}', [ProductController::class, 'update_product'])->name('product.update_product');
    Route::post('/update_status/{id}', [ProductController::class, 'updateStatus'])->name('product.update_status');
});

Route::prefix('category')->group(function () {
    Route::get('/list', [CategoryController::class, 'listCategory'])->name('category.list_category');
    Route::get('/create_category', [CategoryController::class, 'view_create_category'])->name('category.create_category_view');
    Route::post('/create', [CategoryController::class, 'create_category'])->name('category.create_category');
    Route::get('/detail_category/{id}', [CategoryController::class, 'find_one'])->name('category.detail_category');
    Route::post('/update_category/{id}', [CategoryController::class, 'update_category'])->name('category.update_category');
    Route::post('/update_status/{id}', [CategoryController::class, 'updateStatus'])->name('category.update_status');
});


Route::prefix('store')->group(function () {
    Route::get('/list', [StoreController::class, 'getAllStore'])->name('store.list_store');
    Route::get('/create_store', [StoreController::class, 'view_store'])->name('store.view_store');
    Route::post('/create', [StoreController::class, 'create_store'])->name('store.create_store');
    Route::get('/detail_store/{id}', [StoreController::class, 'find_one_store'])->name('store.detail_store');
    Route::post('/update_store/{id}', [StoreController::class, 'update_store'])->name('store.update_store');
    Route::post('/update_status/{id}', [StoreController::class, 'updateStatus'])->name('store.update_status');
});


