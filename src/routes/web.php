<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('/', 'Controller@index');
Route::post('cq/upload', 'CQUploadController@upload');

Route::post('auth/login', 'LoginController');

Route::middleware(['admin.login'])->group(function () {
    Route::post('auth/logout', 'LoginController@logout');

    Route::post('dic/add', 'DictionaryController@add');
    Route::post('dic/get', 'DictionaryController@get');
    Route::post('dic/delete', 'DictionaryController@delete');
    Route::post('dic/update', 'DictionaryController@update');


    Route::post('cq/post/{methods}', "CQUploadController@api");
});


