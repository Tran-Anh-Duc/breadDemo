<?php

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

Route::prefix('product')->group(function () {

});





