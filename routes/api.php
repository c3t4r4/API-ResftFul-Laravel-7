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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1', 'namespace' => 'API\v1'], function() {
    Route::get('/categories/{category}/products', 'CategoryController@products')->name('categories.products');
    Route::apiResource('/categories', 'CategoryController');

    Route::get('/products/{product}/category', 'ProductController@category')->name('products.category');
    Route::apiResource('/products', 'ProductController');
});
