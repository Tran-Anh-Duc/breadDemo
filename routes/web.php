<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TableController;
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
    Route::get('/list_product', [TemplateController::class, 'allProduct'])->name('list');
    Route::get('/view_card', [TemplateController::class, 'view_card'])->name('bread.card');
    Route::get('/add_to_card/{id}', [TemplateController::class, 'add_to_card'])->name('bread.add_to_card')->middleware('auth');
    Route::get('/updateCard', [TemplateController::class, 'updateCard'])->name('bread.updateCard');
    Route::get('/removeCard', [TemplateController::class, 'removeCard'])->name('bread.removeCard');
    Route::get('/searchLikeProduct', [TemplateController::class, 'searchLikeProduct'])->name('bread.searchLikeProduct');
    Route::get('/detailProduct/{id}', [TemplateController::class, 'detailProduct'])->name('bread.detailProduct');
    Route::get('/getALlClick', [TemplateController::class, 'getALlClick'])->name('bread.getALlClick');
    Route::get('/test', [TemplateController::class, 'test'])->name('bread.test');
    Route::get('/tableList', [TemplateController::class, 'viewTable'])->name('bread.tableList');
    Route::get('/findOneTable/{id}', [TemplateController::class, 'detailTable'])->name('bread.findOneTable');
    Route::get('/addCardTable/{idProduct}/{idTable}', [TemplateController::class, 'addCardTable'])->name('bread.addCardTable');
    Route::get('/updateCardTable', [TemplateController::class, 'updateCardTable'])->name('bread.updateCardTable');
    Route::get('/updateStatusOrder/{id}', [TemplateController::class, 'updateStatusOrder'])->name('bread.updateStatusOrder');
    Route::get('/paymentOneTable/{idTable}', [TemplateController::class, 'paymentOneTable'])->name('bread.paymentOneTable');
    Route::post('/createBill', [TemplateController::class, 'createBill'])->name('bread.createBill');
    Route::get('/viewDetailBill/{id}', [TemplateController::class, 'viewDetailBill'])->name('bread.viewDetailBill');
    Route::post('/delete_bill/{bill_id}', [TemplateController::class, 'delete_bill'])->name('bread.delete_bill');
    Route::post('/update_store/{id}', [TemplateController::class, 'update_store'])->name('bread.update_store');



    Route::get('/view_register', [AuthController::class, 'viewRegister'])->name('bread.viewRegister');
    Route::get('/view_login', [AuthController::class, 'viewLogin'])->name('bread.viewLogin');
    Route::post('/register', [AuthController::class, 'register'])->name('bread.register');
    Route::post('/login', [AuthController::class, 'login'])->name('bread.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('bread.logout');
});

Route::prefix('product')->group(function () {
    Route::get('/list', [ProductController::class, 'allDataProduct'])->name('product.list_product');
    Route::get('/create_product', [ProductController::class, 'viewProduct'])->name('product.create_product_view');
    Route::post('/create', [ProductController::class, 'create_product'])->name('product.create_product');
    Route::get('/detail_product/{id}', [ProductController::class, 'find_one'])->name('product.detail_product');
    Route::post('/update_product/{id}', [ProductController::class, 'update_product'])->name('product.update_product');
    Route::post('/update_status/{id}', [ProductController::class, 'updateStatus'])->name('product.update_status');
    Route::post('/uploadImage', [ProductController::class, 'uploadImage'])->name('product.uploadImage');
});

Route::prefix('category')->group(function () {
    Route::get('/list', [CategoryController::class, 'listCategory'])->name('category.list_category');
    Route::get('/create_category', [CategoryController::class, 'view_create_category'])->name('category.create_category_view');
    Route::post('/create', [CategoryController::class, 'create_category'])->name('category.create_category');
    Route::get('/detail_category/{id}', [CategoryController::class, 'find_one'])->name('category.detail_category');
    Route::post('/update_category/{id}', [CategoryController::class, 'update_category'])->name('category.update_category');
    Route::post('/update_status/{id}', [CategoryController::class, 'updateStatus'])->name('category.update_status');
    Route::post('/test', [CategoryController::class, 'test'])->name('category.update_status');
});


Route::prefix('store')->group(function () {
    Route::get('/list', [StoreController::class, 'getAllStore'])->name('store.list_store');
    Route::get('/create_store', [StoreController::class, 'view_store'])->name('store.view_store');
    Route::post('/create', [StoreController::class, 'create_store'])->name('store.create_store');
    Route::get('/detail_store/{id}', [StoreController::class, 'find_one_store'])->name('store.detail_store');
    Route::post('/update_store/{id}', [StoreController::class, 'update_store'])->name('store.update_store');
    Route::post('/update_status/{id}', [StoreController::class, 'updateStatus'])->name('store.update_status');
});


Route::prefix('news')->group(function () {
    Route::get('/list', [NewsController::class, 'getAllNews'])->name('news.list_news');
    Route::post('/create_news', [NewsController::class, 'create_news'])->name('news.create_news');
    Route::get('/view_create_news', [NewsController::class, 'view_create_news'])->name('news.view_create_news');
    Route::post('/update_status/{id}', [NewsController::class, 'update_status'])->name('news.update_status');
    Route::get('/findOneNews/{id}', [NewsController::class, 'findOneNews'])->name('news.findOneNews');
    Route::get('/viewImage', [NewsController::class, 'viewImage'])->name('news.viewImage');
    Route::post('/uploadImage', [NewsController::class, 'uploadImage'])->name('news.uploadImage');
    Route::post('/update_news/{id}', [NewsController::class, 'update_news'])->name('news.update_news');
});
//
Route::prefix('table')->group(function (){
    Route::get('/list', [TableController::class, 'getDataTable'])->name('table.list_table');
    Route::post('/update_status/{id}', [TableController::class, 'update_status'])->name('table.update_status');
    Route::get('view_create',[TableController::class,'view_create_table'])->name('table.view_create');
    Route::post('/create',[TableController::class,'createTable'])->name('table.create');
});

Route::prefix('product_store')->group(function (){
    Route::get('/',[ProductController::class,'getAllDataProductStore'])->name('product_store.list');
    Route::post('/createProductAndStore',[ProductController::class,'createProductAndStore'])->name('product_store.create_product_sotre');
    Route::get('/view_create_product_store',[ProductController::class,'createViewProductStore'])->name('product_store.view_product_store');
});

Route::prefix('bill')->group(function(){
    Route::get('/list',[\App\Http\Controllers\BillController::class,'get_all_data_bill'])->name('bill.get_all_data_bill');
    Route::get('/view_detail_bill/{id}',[\App\Http\Controllers\BillController::class,'view_detail_bill'])->name('bill.view_detail_bill');
});


