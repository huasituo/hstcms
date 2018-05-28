<?php

use Huasituo\Hstcms\Libraries\HstcmsHook;
/**
 * hook
 */

if ( ! function_exists('hstcms_hook'))
{
    function hstcms_hook($hook_name, $data = null, $result = false)
    {
    	$hstcmsHook = new HstcmsHook();
        if($result) {
            return $hstcmsHook->call_hook($hook_name, $data, $result);
        }
        $hstcmsHook->call_hook($hook_name, $data, false);
    }
}