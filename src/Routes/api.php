<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware'=>['api.service']
], function() {
	Route::get('/', function(){
		echo '欢迎Cms Api接口';
	})->name('hstcmsApi');
	Route::get('/test', 'TestController@index')->name('hstcmsApiText');
	Route::post('/test', 'TestController@index')->name('hstcmsApiTextPost');
});
