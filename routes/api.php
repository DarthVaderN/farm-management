<?php



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

Route::get('/', 'ApiController@index');
Route::post('/clone', 'ApiController@clone');
Route::post('/kill', 'ApiController@kill');
Route::put('/status', 'ApiController@status');
Route::delete('/delete','ApiController@delete');

