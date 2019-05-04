<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//restcalls
//sind unabhängig voneinander
//hat keinen bezug zu vorherigen Calls
//damit man die calls auch auf versch. webserver verteilen könnte
Route::get('books', 'BookController@index');
Route::get('orders', 'OrderController@index');
Route::get('book/{isbn}', 'BookController@findByISBN');
Route::get('book/checkisbn/{isbn}', 'BookController@checkISBN');
Route::get('book/search/{searchTerm}', 'BookController@findBySearchTerm');
Route::get('author/search/{searchTerm}', 'AuthorController@findBySearchTerm');


Route::group(['middleware' => ['api', 'cors', 'jwt.auth']], function () {
    Route::post('book', 'BookController@save');
    Route::post('order', 'OrderController@save');
    Route::put('order/{id}', 'OrderController@updateState');
    Route::put('book/{isbn}', 'BookController@update');
    Route::delete('book/{isbn}', 'BookController@delete');
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
});


Route::group(['middleware' => ['api', 'cors']], function () {
    Route::post('auth/login', 'Auth\ApiAuthController@login');
});