<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
/**
 * 获取时间类型
 * @param $str
 * @return string
 */
if ( ! function_exists('hst_changeTimeType'))
{    
    function hst_changeTimeType($seconds)
    {
        $one_day = 3600*24;
        if ($seconds > $one_day) {
            $day = floor($seconds/$one_day);
            $hour = $seconds%$one_day;
            $hour = floor($hour/3600);
            $mimute = ($seconds - $day * $one_day) % 3600 ;
            $mimute = floor($mimute/60);
            $seconds = $seconds - $day * $one_day - $hour * 3600 - $mimute * 60;
            return $day.hst_lang('hstcms::public.day').$hour.hst_lang('hstcms::public.hour').$mimute.hst_lang('hstcms::public.minute').$seconds.hst_lang('hstcms::public.minutes');
        }  elseif($seconds > 3600) {
            $hour = floor($seconds/3600);
            $mimute = $seconds%3600;
            $mimute = floor($mimute/60);
            $seconds = $seconds%3600 - $mimute * 60;
            return $hour.hst_lang('hstcms::public.hour').$mimute.hst_lang('hstcms::public.minute').$seconds.hst_lang('hstcms::public.minutes');
        } elseif($seconds > 60) {
            $mimute = floor($seconds/60);
            $seconds = $seconds - $mimute * 60;
            return $mimute.hst_lang('hstcms::public.minute').$seconds.hst_lang('hstcms::public.minutes');
        }
        return $seconds.hst_lang('hstcms::public.minutes');
    }
}

/**
 * 将时间字串转化成零时区时间戳返回
 *
 * @param string $str 格式良好的时间串
 * @return int
 */
if ( ! function_exists('hst_str2time'))
{    
    function hst_str2time($str) 
    {
        $timestamp = strtotime($str);
        //if ($timezone = self::getConfig('site', 'time.timezone')) $timestamp -= $timezone * 3600;
        return $timestamp;
    }
}

/**
 * 时间戳转字符串
 *
 * @example Y-m-d H:i:s  2012-12-12 12:12:12
 * @param int $timestamp 时间戳
 * @param string $format 时间格式
 * @param int $sOffset 时间矫正值
 * @return string
 */
if ( ! function_exists('hst_time2str'))
{    
    function hst_time2str($timestamp, $format = 'Y-m-d H:i') 
    {
        if (!$timestamp) return '';
        if ($format == 'auto') return hst_time2cpstr($timestamp);
        //if ($timezone = self::getConfig('site', 'time.timezone')) $timestamp += $timezone * 3600;
        return gmdate($format, $timestamp);
    }
}

/**
 * 时间戳转字符串
 *
 * @example Y-m-d H:i:s  2012-12-12 12:12:12
 * @param int $timestamp 时间戳
 * @param string $format 时间格式
 * @param int $sOffset 时间矫正值
 * @return string
 */
if ( ! function_exists('hst_time2cpstr'))
{    
    function hst_time2cpstr($timestamp) 
    {
        $current = hst_time();
        $decrease = $current - $timestamp;
        if ($decrease < 0) return hst_time2str($timestamp);
        if ($decrease < 60) return $decrease . hst_lang('hstcms::public.minutes.front');
        if ($decrease < 3600) return ceil($decrease / 60) . hst_lang('hstcms::public.minute.front');
        $decrease = hst_time2str(hst_time2str($current, 'Y-m-d')) - hst_time2str(hst_time2str($timestamp, 'Y-m-d'));
        if ($decrease == 0) return hst_time2str($timestamp, 'H:i');
        if ($decrease == 86400) return hst_lang('hstcms::public.yesterday') . hst_time2str($timestamp, 'H:i');
        if ($decrease == 172800) return hst_lang('hstcms::public.the.day.before.yesterday') . hst_time2str($timestamp, 'H:i');
        if (hst_time2str($timestamp, 'Y') == hst_time2str($current, 'Y')) return hst_time2str($timestamp, 'm-d H:i');
        return hst_time2str($timestamp);
    }
}

/**
 * 获取矫正过的时间戳值
 *
 * @return int
 */
if ( ! function_exists('hst_time'))
{    
    function hst_time() 
    {
        return time() + 8 * 3600;
    }
}

/**
 * 获取今日零点时间戳
 *
 * @return int
 */
if ( ! function_exists('hst_getTdtime'))
{    
    function hst_getTdtime() 
    {
        return hst_str2time(hst_time2str(hst_time(), 'Y-m-d'));
    }
}

/**
 * 获取今日凌晨时间
 *
 * @return int
 */
if ( ! function_exists('hst_getTdtimeStr'))
{    
    function hst_getTdtimeStr() 
    {
        return hst_time2str(hst_getTdtime(), 'Y-m-d H:i:s');
    }
}