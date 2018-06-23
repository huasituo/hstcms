<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    */
	'version'=>'2.5.8',
    /*
    |--------------------------------------------------------------------------
    | copys
    |--------------------------------------------------------------------------
    */
    'copys'=>'2014',
    /*
    |--------------------------------------------------------------------------
    | Name
    |--------------------------------------------------------------------------
    */
    'name'=>'华思拓CMS系统',
    /*
    |--------------------------------------------------------------------------
    | Website
    |--------------------------------------------------------------------------
    */
    'website'=>'https://www.huasituo.com',
    /*
    |--------------------------------------------------------------------------
    | res  https或http
    |--------------------------------------------------------------------------
    */
    'resurl'=>'http://res.huasituo.com',        
    //'resurl'=> PHP_SAPI === 'cli' ? false : url('res'),
    /*
    |--------------------------------------------------------------------------
    | api
    |--------------------------------------------------------------------------
    */
    'apiDomain'=>env('HSTCMS_API_DOMAIN', ''),
    /*
    |--------------------------------------------------------------------------
    | api prefix
    |--------------------------------------------------------------------------
    */
    'apiPrefix'=>env('HSTCMS_API_PREFIX', ''),
    /*
    |--------------------------------------------------------------------------
    | api sign
    |--------------------------------------------------------------------------
    */
    'apiSign'=>env('HSTCMS_API_SIGN', true),
    /*
    |--------------------------------------------------------------------------
    | Manage
    |--------------------------------------------------------------------------
    */
    'manage'=> [
    	'route'=>[
		    /*
		    |--------------------------------------------------------------------------
		    | Manage Route Domain
		    |--------------------------------------------------------------------------
		    */
    		'domain'=> env('HSTCMS_MANAGE_ROUTE_DOMAIN', ''),
		    /*
		    |--------------------------------------------------------------------------
		    | Manage Route Prefix
		    |--------------------------------------------------------------------------
		    */
    		'prefix'=> env('HSTCMS_MANAGE_ROUTE_PREFIX', 'manage'),
    	]
    ],
    'captcha'=>[
        'width'=> env('CAPTCHA_WIDTH', 120),
        'height'=> env('CAPTCHA_HEIGHT', 60),
        'length'=> env('CAPTCHA_LENGTH', 5)
    ]
];
