<?php

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

use \Illuminate\Support\Facades;
use App\Book;

/**
 * hier auf den Controller verweisen und dann mit @index auf die Methode verweisen
 * das hier ist die default Route
 */
Route::get('/', 'BookController@index');


/**
 *das ist wie oben, aber nicht default. die zeigen auf das selbe und machen das selbe
 * 2 unterschiedliche url, die auf das gleiche zeigen
 */
Route::get('/books', 'BookController@index');

/**
 *
 */
Route::get('books/{id}', 'BookController@show');
//die wildcard {id} soll gleich heißen wie die function
