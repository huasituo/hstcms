<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
use Jenssegers\Agent\Agent;                         //Agent
use Illuminate\Support\Facades\Mail;                //邮箱服务
use Illuminate\Support\Facades\Auth;                //认证

use Huasituo\Hstcms\Model\CommonConfigModel;
use Huasituo\Hstcms\Model\CommonBlockModel;
use Huasituo\Hstcms\Model\ManageUserModel;
use Huasituo\Hstcms\Libraries\HstcmsPinYin;
use Huasituo\Hstcms\Libraries\Hststring;
use Huasituo\Hstcms\Libraries\HstcmsFields;
use Huasituo\Hstcms\Libraries\HstcmsEncrypter;
use Huasituo\Hstcms\Model\ApiModel;


/**
 * 检测是否安装
 *
 */

if ( ! function_exists('hst_checkInstall'))
{
    function hst_checkInstall()
    {
        if (!file_exists(base_path('hstcms.install.lck'))) {
            header('Location:' . route('hstcmsInstallIndex'));
            die(trans('hstcms::public.the.installation.file.was.not.detected'));
        }
    }
}

/**
 * 读取配置信息
 *
 * @param str $name
 * @param str $key
 * @return str|array
 */

if ( ! function_exists('hst_config'))
{
	function hst_config($namespace = '', $name  = null)
    {
        $arrConfig = CommonConfigModel::get($namespace, $name);
        return $arrConfig;
    }
}

/**
 * 读取配置信息
 *
 * @param str $name
 * @param str $key
 * @return str|array
 */

if ( ! function_exists('hst_save_config'))
{
	function hst_save_config($namespace, $data = array())
    {
        $arrConfig = CommonConfigModel::saveVals($namespace, $data);
        return $arrConfig;
    }
}

/**
 * 返回错误信息
 *
 */

if ( ! function_exists('hst_message'))
{
    function hst_message($message  = '', $state = 'error', $data = [])
    {
        $message = [
            'state'=>'error',
            'message'=> hst_lang($message)
        ];
        if($data) {
            $message['data'] = $data;
        }
        return $message;
    }
}

if ( ! function_exists('hst_message_verify'))
{
    function hst_message_verify($message  = '')
    {
        if(!is_array($message)) {
            return false;
        }
        if(!isset($message['state'])) {
            return false;
        }
        if(!isset($message['message'])) {
            return false;
        }
        if($message['state'] == 'error') {
            return true;
        }
        return false;
    }
}

/**
 * Agent
 *
 * @return 
 */
if ( ! function_exists('hst_agent'))
{
    function hst_agent()
    {
        return new Agent();
    }
}
/**
 * lang
 *
 * @return
 */
if( ! function_exists('hst_lang'))
{
    function hst_lang($v = '', $v2 = '') 
    {
        $v2 = $v2 ? trans($v2) : '';
        return trans($v).$v2;
    }
}
/**
 * csrf
 *
 * @return 
 */
if( ! function_exists('hst_csrf'))
{
    function hst_csrf() 
    {
        return csrf_field();
    }
}
/**
 * value
 *
 * @return 
 */
if( ! function_exists('hst_value'))
{
    function hst_value($k = '', $data = array(), $default = '') 
    {
        if(!$k) {
            return '';
        }
        if(old($k)) {
            return old($k);
        }
        if(isset($data[$k]) && $data[$k]) {
            return $data[$k];
        }
        return $default;
    }
}

/**
 * switchx
 *
 * @return 
 */
if( ! function_exists('hst_switch'))
{
    function hst_switch($request = array(), $k = '', $t = false) 
    {
        if($t) {
            $v = isset($request[$k]) && $request[$k] ? 0 : 1;
        } else {
            $v = isset($request[$k]) && $request[$k] ? 1 : 0;
        }
        return $v;
    }
}

/**
 * manager
 *
 * @return 
 */
if ( ! function_exists('hst_manager'))
{
    function hst_manager($v = '')
    {
        $manager = Session::get('manager');
        if(!$manager) {
            return array('uid'=>0, 'username'=>'system');
        }
        $managers = decrypt($manager);
        list($uid, $username, $mobile, $email, $time) = explode('|', $managers);
        $uinfo = ManageUserModel::getUser($uid);
        if(!$uinfo) {
             $uinfo = array('uid'=>0, 'username'=>'system');
        }
        if($v && isset($uinfo[$v])){
            return $uinfo[$v];
        }
        return $uinfo;
    }
}

/**
 * check auth
 *
 * @return 
 */
if ( ! function_exists('hst_check_auth'))
{
    function hst_check_auth($route = '')
    {
        $uinfo = hst_manager();
        $roleInfo = CommonRoleModel::getInfo($uinfo['gid']);
        return in_array($route, $roleInfo['auths']);
    }
}

/**
 * 文件复制
 *
 * @param str $src
 * @param str $dst
 * @return true
 */
if ( ! function_exists('hst_copy'))
{
	function hst_copy($src = '', $dst = '') 
    {
        if(!$src || !$dst) return;
        $dir = @opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) 
        {
            if (( $file != '.' ) && ( $file != '..' )) 
            {
                if ( is_dir($src . '/' . $file) ) 
                {
                    hst_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else 
                {
                    @copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        @closedir($dir);
        return true;
    }
}

/**
 * 生产随机码
 *
 * @param int $length
 * @param bloom $intmode
 * @return str
 */
if ( ! function_exists('hst_random'))
{
	function hst_random($length = 4, $intmode = false)
    {
        $hash = '';
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $intmode and $chars = "0123456789";
        $max = strlen($chars) - 1;
        PHP_VERSION < '4.2.0' && mt_srand(( double )microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars [mt_rand(0, $max)];
        }
        return $hash;
    }
}

/**
 * md5加密
 *
 * @param str $str
 * @param int $salt
 * @return str
 */
if ( ! function_exists('hst_md5'))
{
	function hst_md5($str, $salt = '')
    {
        return md5(md5($str . $salt));
    }
}

/**
 * 字符串星号替换
 *
 * @param str $str
 * @param int $start
 * @param int $length
 * @return str
 */
if ( ! function_exists('hst_star_replace'))
{
	function hst_star_replace($str, $start, $length = 0)
    {
        $i = 0;
        $star = '';
        if ($start >= 0) {
            if ($length > 0) {
                $str_len = strlen($str);
                $count = $length;
                if ($start >= $str_len) {//当开始的下标大于字符串长度的时候，就不做替换了
                    $count = 0;
                }
            } elseif ($length < 0) {
                $str_len = strlen($str);
                $count = abs($length);
                if ($start >= $str_len) {//当开始的下标大于字符串长度的时候，由于是反向的，就从最后那个字符的下标开始
                    $start = $str_len - 1;
                }
                $offset = $start - $count + 1;//起点下标减去数量，计算偏移量
                $count = $offset >= 0 ? abs($length) : ($start + 1);//偏移量大于等于0说明没有超过最左边，小于0了说明超过了最左边，就用起点到最左边的长度
                $start = $offset >= 0 ? $offset : 0;//从最左边或左边的某个位置开始
            } else {
                $str_len = strlen($str);
                $count = $str_len - $start;//计算要替换的数量
            }
        } else {
            if ($length > 0) {
                $offset = abs($start);
                $count = $offset >= $length ? $length : $offset;//大于等于长度的时候 没有超出最右边
            } elseif ($length < 0) {
                $str_len = strlen($str);
                $end = $str_len + $start;//计算偏移的结尾值
                $offset = abs($start + $length) - 1;//计算偏移量，由于都是负数就加起来
                $start = $str_len - $offset;//计算起点值
                $start = $start >= 0 ? $start : 0;
                $count = $end - $start + 1;
            } else {
                $str_len = strlen($str);
                $count = $str_len + $start + 1;//计算需要偏移的长度
                $start = 0;
            }
        }
        while ($i < $count) {
            $star .= '*';
            $i++;
        }
        return substr_replace($str, $star, $start, $count);
    }
}

/**
 * 检测字符串为json数据
 *
 * @param $str
 * @return bool
 */
if ( ! function_exists('hst_isJson'))
{    
    function hst_isJson($str)
    {
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

/**
 * 数组转换成xml
 *
 * @param $arr
 * @return string
 */
if ( ! function_exists('hst_arrayToXml'))
{    
    function hst_arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }
}

/**
 * xml转换成array
 *
 * @param $xml
 * @return mixed
 */
if ( ! function_exists('hst_xmlToArray'))
{    
    function hst_xmlToArray($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";

            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }
}

/**
 * 获取参数
 *
 * @param $queryString
 * @return mixed
 */
if ( ! function_exists('hst_getParamByQueryString'))
{    
    function hst_getParamByQueryString($queryString)
    {
        parse_str(preg_replace("/(\w+)=/", '$1[]=', $queryString), $arr);
        foreach ($arr as $k => $v) {
            if (count($v) > 1) {
                $arr[$k] = $v;
            } else {
                $arr[$k] = $v[0];
            }
        }
        return $arr;
    }
}

/**
 * 数组以某个字段的值为键值
 * @param $data
 * @param $key
 * @return array
 */
if ( ! function_exists('hst_keyBy'))
{    
    function hst_keyBy($data, $key)
    {
        $array = [];
        foreach($data as $v) {
            $array[$v[$key]] = $v;
        }
        return $array;
    }
}

/**
 * 数组以某一个字段值为键，并分组
 * @param $data
 * @param $key
 * @return array
 */
if ( ! function_exists('hst_keyByGroup'))
{    
    function hst_keyByGroup($data, $key)
    {
        $array = array();
        foreach($data as $v)
        {
            $array[$v[$key]][] = $v;
        }
        return $array;
    }
}

/**
 * 获取概率
 * @param $proArr
 * @param $randNum
 * @return string
 */
if ( ! function_exists('hst_rand'))
{    
    function hst_rand($proArr) {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        return $result;
    }
}

/**
 * 返回html checked
 *
 * @param boolean $var
 * @return string
 */
if ( ! function_exists('hst_ifcheck'))
{    
    function hst_ifcheck($var) 
    {
        return $var ? ' checked' : '';
    }
}

/**
 * 返回html selected
 *
 * @param boolean $var
 * @return string
 */
if ( ! function_exists('hst_isSelected'))
{    
    function hst_isSelected($var) 
    {
        return $var ? ' selected' : '';
    }
}

/**
 * 返回html current
 *
 * @param boolean $var
 * @param string $type
 * @return string
 */
if ( ! function_exists('hst_isCurrent'))
{    
    function hst_isCurrent($var, $type = 'current') 
    {
        return $var ? ' '.$type : '';
    }
}

/**
 * 判断env函数值是否为空
 * @param $key
 * @return bool
 */
if ( ! function_exists('hst_checkEnvIsNull'))
{    
    function hst_checkEnvIsNull($key)
    {
        $value = env($key);
        if($value === '' || $value === null)
        {
            return false;
        }else{
            return true;
        }
    }
}

/**
 * 查询env文件中某一变量的值
 * @param $key
 * @return mixed|string
 */
if ( ! function_exists('hst_findEnvInfo'))
{    
    function hst_findEnvInfo($key)
    {
        if(array_key_exists($key, $_ENV))
        {
            $envInfo = env($key) ? env($key) : ( $_ENV[$key] ? $_ENV[$key] : '' );
        }else{
            $envInfo = env($key);
        }
        return $envInfo;
    }
}

/**
 * 更新env文件中某一变量的值
 * @param $data
 * @return mixed|string
 */
if ( ! function_exists('hst_updateEnvInfo'))
{    
    function hst_updateEnvInfo($data)
    {
        if(is_array($data)) {
            foreach ($data as $key => $value) 
            {
                $path = base_path('.env');
                $originStr = file_get_contents($path);
                if(strstr($originStr, $key)) {
                    $str = $key . "=" . $value;
                    $res = hst_checkEnvIsNull($key);
                    if($res) {
                        $newStr = $key."=".env($key);
                    } else {
                        if(hst_findEnvInfo($key)) {
                            $newStr = $key.'='.hst_findEnvInfo($key);
                        } else {
                            $newStr = $key.'=';
                        }
                    }
                    if($newStr == 'APP_DEBUG=1') {
                        $newStr = 'APP_DEBUG=true';
                    }
                    if($newStr == 'APP_DEBUG=0') {
                        $newStr = 'APP_DEBUG=false';
                    }
                    $updateStr = str_replace($newStr, $str, $originStr);
                    file_put_contents($path, $updateStr);
                } else {
                    if($key === 'ENV_EOL') {
                        $str = "\n";
                    } else {
                        $str = "\n" .$key . "=" . $value;
                    }
                    file_put_contents($path, $str, FILE_APPEND);
                }
            }
        }
        return true;
    }
}

/**
 * 获取IP
 * @return str
 */
if ( ! function_exists('hst_ip'))
{    
    function hst_ip()
    {
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
}

/**
 * 获取端口
 * @return str
 */
if ( ! function_exists('hst_port'))
{    
    function hst_port()
    {
        $port = isset($_SERVER["REMOTE_PORT"]) ? $_SERVER["REMOTE_PORT"] : '';
        return $port;
    }
}

/**
 * 防止跨站攻击
 * @return str
 */
if ( ! function_exists('hst_removeXss'))
{    
    function hst_removeXss($val)
    {
        $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search.= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search.= '1234567890!@#$%^&*()';
        $search.= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);
            $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);
        }
        $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta','blink', 'link',  'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title');
        $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);
        $found = true;
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
                        $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
                        $pattern .= ')?';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
                $val = preg_replace($pattern, $replacement, $val);
                if ($val_before == $val) {
                    $found = false;
                }
            }
        }
        return $val;
    }
}

/**
 * 关键字高亮显示
 *
 * @param   string  $string     字符串
 * @param   string  $keyword    关键字
 * @return  string
 */
if ( ! function_exists('hst_keyword_highlight'))
{
	function hst_keyword_highlight($string, $keyword)
	{
	    return $keyword != '' ? str_ireplace($keyword, '<font color="red" class="keyword_highlight" >' . $keyword . '</font>', $string) : $string;
	}
}
/**
 * 随机颜色 **
 *
 * @return  string
 */
if ( ! function_exists('hst_random_color'))
{
	function hst_random_color()
	{
	    $str = '#';
	    for ($i = 0; $i < 6; $i++)
	    {
	        $randNum = rand(0, 15);
	        switch ($randNum)
	        {
	            case 10: $randNum = 'A';
	                break;
	            case 11: $randNum = 'B';
	                break;
	            case 12: $randNum = 'C';
	                break;
	            case 13: $randNum = 'D';
	                break;
	            case 14: $randNum = 'E';
	                break;
	            case 15: $randNum = 'F';
	                break;
	        }
	        $str.= $randNum;
	    }
	    return $str;
	}
}

/**
 * 汉字转为拼音
 *
 * @param	string	$word
 * @return	string
 */
if ( ! function_exists('hst_word2pinyin'))
{
	function hst_word2pinyin($word, $quanpin = true, $daxie = false, $trim = false, $szm = false) 
	{
        if($szm) {
            return substr(HstcmsPinYin::result($word, $quanpin, $daxie, $trim), 0, 1);
        }
        return HstcmsPinYin::result($word, $quanpin, $daxie, $trim);
	}
}

/**
 * 重写in_array
 *
 * @param int|string $value
 * @param array $array
 * @return bool
 */
if ( ! function_exists('hst_inArray'))
{ 
	function hst_inArray($value, $array) 
	{
		return is_array($array) && in_array($value, $array);
	}
}

/**
 * 页码转sql
 *
 * @param int $page 分页
 * @param int $perpage 每页显示数
 * @return array <1.start 2.limit>
 */
if ( ! function_exists('hst_page2limit'))
{	
	function hst_page2limit($page, $perpage = 10) 
	{
		$limit = intval($perpage);
		$start = max(($page - 1) * $limit, 0);
		return array($start, $limit);
	}
}

/**
 * 将字符串转换为数组
 *
 * @param	string	$data	字符串
 * @return	array
 */
if ( ! function_exists('hst_str2array'))
{	
	function hst_str2array($data) 
	{
		return $data ? (is_array($data) ? $data : @unserialize(stripslashes($data))) : array();
	}
}

/**
 * 将数组转换为字符串
 *
 * @param	array	$data	数组
 * @return	string
 */	
if ( ! function_exists('hst_array2str'))
{	
	function hst_array2str($data) 
	{
		return $data ? (!is_array($data) ? $data : addslashes(@serialize($data))) : '';
	}
}	

/**
 * 去除数组重复的
 *
 * @param	array	
 * @return	array
 */
if ( ! function_exists('hst_array_unique'))
{	
	function hst_array_unique($array)//写的比较好
	{
	   $out = array();
	   foreach ($array as $key=>$value) 
	   {
	       if (!in_array($value, $out))
	       {
	           $out[$key] = $value;
	       }
	   }
	   return $out;
	}
}

/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
if ( ! function_exists('hst_safe_replace'))
{
	function hst_safe_replace($string) 
	{
		$string = str_replace('%20', '', $string);
		$string = str_replace('%27', '', $string);
		$string = str_replace('%2527', '', $string);
		$string = str_replace('*', '', $string);
		$string = str_replace('"', '&quot;', $string);
		$string = str_replace("'", '', $string);
		$string = str_replace('"', '', $string);
		$string = str_replace(';', '', $string);
		$string = str_replace('<', '&lt;', $string);
		$string = str_replace('>', '&gt;', $string);
		$string = str_replace("{", '', $string);
		$string = str_replace('}', '', $string);
		return $string;
	}
}

/**
 * 清除HTML标记
 *
 * @param	string	$str
 * @return  string
 */
if ( ! function_exists('hst_clearhtml'))
{
	function hst_clearhtml($str) 
	{
		$str = str_replace(
			array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '"', '"', '—', '<', '>', '·', '…'), $str
		);
		$str = preg_replace("/\<[a-z]+(.*)\>/iU", "", $str);
		$str = preg_replace("/\<\/[a-z]+\>/iU", "", $str);
		$str = preg_replace("/{.+}/U", "", $str);
		$str = str_replace(array(chr(13), chr(10), '&nbsp;'), '', $str);
		$str = strip_tags($str);
		return trim($str);
	}
}

/**
 * Formats a numbers as bytes, based on size, and adds the appropriate suffix
 *
 * @param	mixed	will be cast as int
 * @param	int
 * @return	string
 */
if ( ! function_exists('hst_byte_format'))
{
	function hst_byte_format($num, $precision = 1) {
		if ($num >= 1000000000000) {
			$num = round($num / 1099511627776, $precision);
			$unit = 'TB';
		} elseif ($num >= 1000000000) {
			$num = round($num / 1073741824, $precision);
			$unit = 'GB';
		} elseif ($num >= 1000000) {
			$num = round($num / 1048576, $precision);
			$unit = 'MB';
		} elseif ($num >= 1000) {
			$num = round($num / 1024, $precision);
			$unit = 'KB';
		} else {
			$unit = 'Bytes';
			return number_format($num).' '.$unit;
		}
		return number_format($num, $precision).' '.$unit;
	}
}

/**
 * 检查目录权限
 *
 * @param	string	$pathfile
 * @return  string
 */
if ( ! function_exists('hst_check_write_able'))
{
	function hst_check_write_able($pathfile) 
	{
		if (!$pathfile) {
            return false;
        }
		$isDir = in_array(substr($pathfile, -1), array('/', '\\')) ? true : false;
		if ($isDir) {
			if (is_dir($pathfile)) {
				mt_srand((double) microtime() * 1000000);
				$pathfile = $pathfile . 'hst_' . uniqid(mt_rand()) . '.tmp';
			} elseif (@mkdir($pathfile))  {
				return hst_check_write_able($pathfile);
			} else {
				return false;
			}
		}
		@chmod($pathfile, 0777);
		$fp = @fopen($pathfile, 'ab');
		if ($fp === false) {
            return false;
        }
		fclose($fp);
		$isDir && @unlink($pathfile);
		return true;
	}
}

if ( ! function_exists('hst_strLen'))
{
    /**
     * 求取字符串长度
     *
     * @param string $string
     * @param string $charset
     * @return string
     */
    function hst_strLen($string, $charset = '')
    {
        return Hststring::strlen($string, $charset);
    }
}

if ( ! function_exists('hst_buildContent'))
{
    /**
     * 内容替换/支持语音包
     *
     * @return string
     */
    function hst_buildContent($content = '', $strReplaces = [])
    {
        $content = hst_lang($content);
        if(!is_array($strReplaces)) {
            return $content;
        }
        $search = [];
        $replace = [];
        foreach ($strReplaces as $key => $value) {
            $search[] = '{'.$key.'}';
            $replace[] = $value;
        }
        return str_replace($search, $replace, $content);
    }
}

if ( ! function_exists('hst_api_app'))
{
    /**
     * 
     */
    function hst_api_app($appid = '')
    {
        $cacheName = 'hstcms:api';
        if (!Cache::has($cacheName)) {
            $data = ApiModel::setCache();
        } else {
            $data = Cache::get($cacheName, []);
        }
        if($appid) {
            return isset($data[$appid]) ? $data[$appid] : [];
        }
        return $data;
    }
}

if ( ! function_exists('hst_get_data'))
{
    function hst_get_data($field = [], $data = [])
    {
        $hstcmsFields = new HstcmsFields();
        $obj = $hstcmsFields->get($field['fieldType']);
        if (!is_object($obj)) {
            return $data;
        }
        return $obj->output_data($data, $field);
    }
}

if ( ! function_exists('hst_block'))
{
    function hst_block($id = 0, $data = false)
    {
        if(!$id && $data == false) {
            return '';
        }
        if(!$id && $data != false) {
            return [];
        }
        return CommonBlockModel::showBlock($id, $data);
    }
}


if ( ! function_exists('hst_is_mobile'))
{
    /**
     * 判断是否是移动端访问
     */
    function hst_is_mobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return TRUE;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
        }
        // 判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'mobile',
                'nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return TRUE;
            }
        }
        if (isset ($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

if ( ! function_exists('hst_is_weixin'))
{
    function hst_is_weixin() 
    { 
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true; 
        }
        return false; 
    }  
}

/**
 * 数组转树
 * @param type $list
 * @param type $root
 * @param type $pk
 * @param type $pid
 * @param type $child
 * @return type
 */
if ( ! function_exists('hst_list_to_tree'))
{
    function hst_list_to_tree($list, $root = 0, $pk = 'id', $pid = 'parentid', $child = '_child') 
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = &$list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = 0;
                if (isset($data[$pid])) {
                    $parentId = $data[$pid];
                }
                if ($root == $parentId) {
                    $tree[] = &$list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent = &$refer[$parentId];
                        $parent[$child][] = &$list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}

if ( ! function_exists('hst_encrypt'))
{
    function hst_encrypt($value = '', $key = '', $serialize = false)
    {
        $key = hst_key($key);
        $HstcmsEncrypter = new HstcmsEncrypter($key, config('app.cipher'));
        $str = $HstcmsEncrypter->encrypt($value, $serialize);
        if(!config('hstcms.crypt')) {
            return $str;
        }
        $cacheName = 'crypt:'.md5($value.$key);
        Cache::forget($cacheName);
        Cache::forever($cacheName, $str);
        return md5($value.$key);
    }  
}

if ( ! function_exists('hst_decrypt'))
{
    function hst_decrypt($value = '', $key = '', $serialize = false)
    {
        $key = hst_key($key);
        if(config('hstcms.crypt')) {
            $cacheName = 'crypt:'.md5($value.$key);
            $value = Cache::get($cacheName, '');
        }
        if(!$value) {
            return hst_message('The payload is invalid.', 'error');
        }
        $HstcmsEncrypter = new HstcmsEncrypter($key, config('app.cipher'));
        $str = $HstcmsEncrypter->decrypt($value, $serialize);
        return $str;
    }
}

if ( ! function_exists('hst_key'))
{
    function hst_key($key = '')
    {
        $key = $key ? $key : 'safe';
        $Salt = 'ChinesePublicSecurity';
        $keyLength = config('app.cipher') == 'AES-128-CBC' ? 16 : 32;
        $key = $keyLength == 32 ? md5($key.md5($Salt)) : substr(md5($key.md5($Salt)), 8, 16); 
        return $key;
    }  
}

if ( ! function_exists('hst_encode'))
{
    /*
    * 加密解密方法
    *  $tmp1 = diy_encode('tex','key'); //加密
    *  $tmp2 = diy_encode($tmp1,'key','decode'); //解密
    */
    function hst_encode($tex, $key, $type="encode")
    {
        $key = $key ? $key : '(@#$!$!$fgbcvnGHJKUX*(#$%^$%%*)(*)_$%fgbcvnGHJKUX@#*&*)(*_()*(O$%^$%SDF3456F$#^';
        $chrArr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
                      'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                      '0','1','2','3','4','5','6','7','8','9');
        if($type == "decode") {
            if(strlen($tex) < 14) return false;
            $verity_str = substr($tex, 0, 8);
            $tex=substr($tex, 8);
            if($verity_str != substr(md5($tex), 0, 8)) { //完整性验证失败
                return false;
            }
        }
        $key_b = $type == "decode" ? substr($tex, 0, 6):$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62].$chrArr[rand()%62];
        $rand_key = $key_b.$key;
        $rand_key = md5($rand_key);
        $tex = $type == "decode" ? base64_decode(substr($tex, 6)) : $tex;
        $texlen = strlen($tex);
        $reslutstr = "";
        for($i = 0; $i < $texlen; $i++) {
            $reslutstr .= $tex{$i}^$rand_key{$i%32};
        }
        if($type != "decode") {
            $reslutstr = trim($key_b.base64_encode($reslutstr), "==");
            $reslutstr = substr(md5($reslutstr), 0,8).$reslutstr;
        }
        return $reslutstr;
    }
}



























