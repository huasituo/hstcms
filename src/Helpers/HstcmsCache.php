<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */

/**
 * 检测验证码是否正确
 *
 * @param string $code
 * @return bool
 */
if ( ! function_exists('hst_cache_total_increment'))
{
    function hst_cache_total_increment($name, $val = 1)
    {
        $cacheName = 'hstcms:total:'.$name;
        if (!Cache::has($cacheName)) {
            Cache::forever($cacheName, $val);
        } else {
        	$number = Cache::get($cacheName, 0);
            Cache::forever($cacheName, $number + $val);
        }
    }
}

if ( ! function_exists('hst_cache_total_decrement'))
{
    function hst_cache_total_decrement($name, $val = 1)
    {
        $cacheName = 'hstcms:total:'.$name;
        if (!Cache::has($cacheName)) {
            Cache::forever($cacheName, $val);
        } else {
        	$number = Cache::get($cacheName, 0);
            Cache::forever($cacheName, $number - $val);
        }
    }
}

if ( ! function_exists('hst_cache_total'))
{
    function hst_cache_total($name)
    {
        $cacheName = 'hstcms:total:'.$name;
        if (!Cache::has($cacheName)) {
            return 0;
        } else {
        	return Cache::get($cacheName, 0);
        }
    }
}

if ( ! function_exists('hst_cache_total_del'))
{
    function hst_cache_total_del($name)
    {
        $cacheName = 'hstcms:total:'.$name;
        if (Cache::has($cacheName)) {
        	Cache::forget($cacheName);
        }
    }
}