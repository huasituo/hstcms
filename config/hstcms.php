<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    */
	'version'=>'1.0.0',
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
    | res
    |--------------------------------------------------------------------------
    */
    'resurl'=>'http://res.huasituo.com',
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
    ]
];