<?php

/**
 * 获取域名
 * @param $url
 * @return string
 */
if ( ! function_exists('hst_domain'))
{    
    function hst_domain($url = '')
    {
        return url($url);
    }
}

/**
 * 获取publc目录所有地址
 *
 * @param   string  $path
 * @return  string
 */
if ( ! function_exists('hst_public'))
{
    function hst_public($path, $domain = true) {
        if($domain) {
            return hst_domain('/'.$path);
        }
    }
}

/**
 * 获取assets目录所有地址
 *
 * @param   string  $path
 * @return  string
 */
if ( ! function_exists('hst_assets'))
{
    function hst_assets($path) {
        if(hst_config('site', 'assets.url')) {
            return hst_config('site', 'assets.url').'/'.$path;
        } else {
            return hst_domain('/assets/'.$path);
        }
    }
}

/**
 * 将数组格式的参数列表转换为Url格式，并将url进行编码处理
 * 
 * <code>参数:array('b'=>'b','c'=>'index','d'=>'d')
 * 分割符: '&='
 * 转化结果:&b=b&c=index&d=d
 * 如果分割符为: '/' 则转化结果为: /b/b/c/index/d/d/</code>
 * @param array $args
 * @param boolean $encode 是否进行url编码 默认值为false
 * @param string $separator url分隔符 支持双字符,前一个字符用于分割参数对,后一个字符用于分割键值对
 * @return string
 */
if( ! function_exists('hst_argsToUrl'))
{
    function hst_argsToUrl($args, $encode = false, $separator = '&=', $key = null) {
        if (strlen($separator) !== 2) return;
        $_tmp = '';
        foreach ((array) $args as $_k => $_v) {
            if ($key !== null) $_k = $key . '[' . $_k . ']';
            if (is_array($_v)) {
                $_tmp .= hst_argsToUrl($_v, $encode, $separator, $_k) . $separator[0];
                continue;
            }
            $_v = $encode ? rawurlencode($_v) : $_v;
            if (is_int($_k)) {
                $_v && $_tmp .= $_v . $separator[0];
                continue;
            }
            $_k = ($encode ? rawurlencode($_k) : $_k);
            $_tmp .= $_k . $separator[1] . $_v . $separator[0];
        }
        return trim($_tmp, $separator[0]);
    }
}

if( ! function_exists('hst_getUrlArgs'))
{
    function hst_getUrlArgs($args, $key, $is = false) {
        $urlargs = '';
        $_args  = array();
        if (!is_array($args) || !$args) return $is ? $urlargs : $_args;
        foreach ($args as $k => $v) {
            if ($k == $key || !$v || (is_array($key) && in_array($k, $key))) continue;
            if($is) {
                $urlargs .= "&$k=$v";
            } else {
                $_args[$k] = $v;
            }
        }
        return $is ? trim($urlargs, '&') : $_args;
    }
}