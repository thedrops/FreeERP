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

Route::prefix('cliente')->group(function() {
    Route::get('/', 'ClienteController@index');
    Route::get('/cadastrar', 'ClienteController@create');
    Route::get('/juridico', 'ClienteController@juridico');
    Route::post('/store', 'ClienteController@store');
});