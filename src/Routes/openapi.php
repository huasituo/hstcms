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
    'middleware'=>['openapi.check.app', 'openapi.check.sign', 'hstsms.check.api']
], function() {
	Route::get('/', function() {
		echo '欢迎开放平台Cms Api接口';
	})->name('hstcmsOpenApi');
	Route::get('/test', 'TestController@index')->name('hstcmsOpenApiTest');						//测试接口
});