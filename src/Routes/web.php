<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//后台路由
Route::group([
    'domain'=> config('hstcms.manage.route.domain'),
    'prefix' => config('hstcms.manage.route.prefix'),
    'middleware' => 'manage.request.log'
], function() {
    Route::get('/login', 'Manage\AuthController@login')->name('manageAuthLogin');
    Route::post('/dologin', 'Manage\AuthController@dologin')->name('manageAuthDoLogin');
    Route::get('/logout', 'Manage\AuthController@logout')->name('manageAuthLogout');
});

Route::group([
    'domain'=> config('hstcms.manage.route.domain'),
    'prefix' => config('hstcms.manage.route.prefix'),
    'middleware'=>['web','manage.auth.check', 'manage.request.log']
], function() {
    //框架                                        
    Route::get('/', 'Manage\IndexController@index')->name('manageIndex');    
    //首页
    Route::get('/home', 'Manage\IndexController@main')->name('manageHome'); 
    //常用设置
    Route::get('/custom/set', 'Manage\IndexController@customSet')->name('manageCustomSet');  
    //修改资料
    Route::get('/user/info/edit/{uid}', 'Manage\IndexController@userInfoEdit')->name('manageUserInfoEdit');
    Route::post('/user/info/edit/save', 'Manage\IndexController@userInfoEditSave')->name('manageUserInfoEditSave');
    //创始人
    Route::get('/founder', 'Manage\FounderController@index')->name('manageFounderIndex');
    Route::get('/founder/add', 'Manage\FounderController@add')->name('manageFounderAdd');
    Route::post('/founder/add/save', 'Manage\FounderController@addSave')->name('manageFounderAddSave');
    Route::get('/founder/edit/{uid}', 'Manage\FounderController@edit')->name('manageFounderEdit');
    Route::post('/founder/edit/save', 'Manage\FounderController@editSave')->name('manageFounderEditSave');
    Route::any('/founder/delete/{uid}', 'Manage\FounderController@delete')->name('manageFounderDelete');
    //员工账号
    Route::get('/user', 'Manage\UserController@index')->name('manageUserIndex');
    Route::get('/user/add', 'Manage\UserController@add')->name('manageUserAdd');
    Route::post('/user/add/save', 'Manage\UserController@addSave')->name('manageUserAddSave');
    Route::get('/user/edit/{uid}', 'Manage\UserController@edit')->name('manageUserEdit');
    Route::post('/user/edit/save', 'Manage\UserController@editSave')->name('manageUserEditSave');
    Route::post('/user/delete/{uid}', 'Manage\UserController@delete')->name('manageUserDelete');
    //角色
    Route::get('/role', 'Manage\RoleController@index')->name('manageRoleIndex');
    Route::get('/role/add', 'Manage\RoleController@add')->name('manageRoleAdd');
    Route::post('/role/add/save', 'Manage\RoleController@addSave')->name('manageRoleAddSave');
    Route::get('/role/edit/{id}', 'Manage\RoleController@edit')->name('manageRoleEdit');
    Route::post('/role/edit/save', 'Manage\RoleController@editSave')->name('manageRoleEditSave');
    Route::post('/role/delete/{id}', 'Manage\RoleController@delete')->name('manageRoleDelete');
    //菜单
    Route::get('/menu/nav', 'Manage\MenuController@nav')->name('manageMenuNav');
    Route::get('/menu/nav/add', 'Manage\MenuController@navAdd')->name('manageMenuNavAdd');
    Route::post('/menu/nav/add/save', 'Manage\MenuController@navAddSave')->name('manageMenuNavAddSave');
    Route::get('/menu/nav/edit/{id}', 'Manage\MenuController@navEdit')->name('manageMenuNavEdit');
    Route::post('/menu/nav/edit/save', 'Manage\MenuController@navEditSave')->name('manageMenuNavEditSave');
    Route::post('/menu/nav/delete/{id}', 'Manage\MenuController@navDelete')->name('manageMenuNavDelete');
    //权限点
    Route::get('/menu/role', 'Manage\MenuController@role')->name('manageMenuRole');
    Route::get('/menu/role/add', 'Manage\MenuController@roleAdd')->name('manageMenuRoleAdd');
    Route::post('/menu/role/add/save', 'Manage\MenuController@roleAddSave')->name('manageMenuRoleAddSave');
    Route::get('/menu/role/edit/{id}', 'Manage\MenuController@roleEdit')->name('manageMenuRoleEdit');
    Route::post('/menu/role/edit/save', 'Manage\MenuController@roleEditSave')->name('manageMenuRoleEditSave');
    Route::post('/menu/role/delete/{id}', 'Manage\MenuController@roleDelete')->name('manageMenuRoleDelete');
    //安全配置
    Route::get('/safe', 'Manage\SafeController@index')->name('manageSafeIndex');
    Route::post('/safe/save', 'Manage\SafeController@save')->name('manageSafeSave');
    //日志
    Route::get('/log/request', 'Manage\LogController@logRequest')->name('manageLogRequest');
    Route::get('/log/operation', 'Manage\LogController@logOperation')->name('manageLogOperation');
    Route::get('/log/operation/view/{id}', 'Manage\logController@LogOperationView')->name('manageLogOperationView');
    Route::get('/log/login', 'Manage\LogController@logLogin')->name('manageLogLogin');
    //邮箱配置
    Route::get('/config/email', 'Manage\EmailController@index')->name('manageConfigEmailIndex');
    Route::post('/config/email/save', 'Manage\EmailController@save')->name('manageConfigEmailSave');
    Route::get('/config/email/test', 'Manage\EmailController@test')->name('manageConfigEmailTest');
    Route::post('/config/email/test/submit', 'Manage\EmailController@testSubmit')->name('manageConfigEmailTestSubmit');
    //FTP配置
    Route::get('/config/ftp', 'Manage\FtpController@index')->name('manageConfigFtpIndex');
    Route::post('/config/ftp/save', 'Manage\FtpController@save')->name('manageConfigFtpSave');

    //短信服务
    Route::get('/sms', 'Manage\SmsController@index')->name('manageSms');
    Route::post('/sms/save', 'Manage\SmsController@save')->name('manageSmsSave');
    Route::get('/sms/config', 'Manage\SmsController@config')->name('manageSmsConfig');
    Route::post('/sms/config/save', 'Manage\SmsController@configSave')->name('manageSmsConfigSave');
    Route::get('/sms/hstsms/config', 'Manage\SmsController@hstsmsConfig')->name('manageSmsHstsmsConfig');
    Route::post('/sms/hstsms/config/save', 'Manage\SmsController@hstsmsConfigSave')->name('manageSmsHstsmsConfigSave');
    Route::get('/sms/hstsms/buy', 'Manage\SmsController@hstsmsBuy')->name('manageSmsHstsmsBuy');
    Route::get('/sms/log', 'Manage\SmsController@log')->name('manageSmsLog');
    Route::get('/sms/log/view/{id}', 'Manage\SmsController@logView')->name('manageSmsLogView');

    //附件服务
    Route::get('/attachments', 'Manage\AttachmentController@index')->name('manageAttach');
    Route::post('/attachments/save', 'Manage\AttachmentController@save')->name('manageAttachSave');

    //API服务
    Route::get('/api', 'Manage\ApiController@index')->name('manageApi');
    Route::post('/api/save', 'Manage\ApiController@save')->name('manageApiSave');

});

//安装路由器
Route::group(['prefix' => 'install', 'middleware'=>['web']], function() {
    Route::get('/', 'Install\InstallController@index')->name('hstcmsInstallIndex');
    Route::post('/checkDatabase', 'Install\InstallController@checkDatabase')->name('hstcmsInstallCheckDatabase');
});

//测试路由
Route::group([
    'domain'=> config('hstcms.manage.route.domain') ? env('APP_URL') : '' ,
    'middleware'=>['web']
], function() {
    Route::get('/test', 'TestController@index')->name('hstcmsTextIndex');
    Route::post('/test/post', 'TestController@pindex')->name('hstcmsTextIndexPost');


    Route::any('/wechat/api', 'TestController@wechat')->name('hstcmsTextWechat');   

});


