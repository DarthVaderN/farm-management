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
Route::get('/', 'ApiController@index')->name('home');
Route::get('/clone', 'ApiController@clone')->name('clone');
Route::get('/kill', 'ApiController@kill')->name('kill');
Route::get('/status', 'ApiController@status')->name('status');
Route::get('/delete','ApiController@delete')->name('delete');
