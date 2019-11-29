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

Route::get('/', function () {
    return view('welcome');
});

/**
 * Thread controller
 */
Route::get('/threads','ThreadController@index');
Route::get('/threads/create','ThreadController@create');
Route::get('/threads/{thread}','ThreadController@show');
Route::post('/threads/store','ThreadController@store');
/**
 * Reply controller
 */
Route::post('/threads/{thread}/replies','ReplyController@store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

