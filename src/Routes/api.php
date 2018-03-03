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

// Route::get('/manage', function (Request $request) {
   
// })->middleware('auth:api');
Route::group([
    'domain'=> '',
    'prefix' => '',
    'middleware'=>['api.service']
], function() {
	Route::get('/test', 'Api\TestController@index')->name('hstcmsApiTextIndex');
});
