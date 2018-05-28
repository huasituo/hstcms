<?php

use Gregwar\Captcha\CaptchaBuilder;

/**
 * 检测验证码是否正确
 *
 * @param string $code
 * @return bool
 */
if ( ! function_exists('hst_captcha_check_code'))
{
    function hst_captcha_check_code($code)
    {
        $builder = new CaptchaBuilder(Session::get('phrase'));
        if ($builder->testPhrase($code)) {
            return true;
        }
        return false;
    }
}