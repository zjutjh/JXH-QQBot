<?php

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
Route::post('cq/upload', 'CQUploadController@upload');
Route::post('dic/add', 'DictionaryController@add');
Route::post('dic/get', 'DictionaryController@get');
Route::post('dic/update', 'DictionaryController@update');
