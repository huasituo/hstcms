<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Libraries;

use Cache;
/**
 * @param $url 网址
 * @param bool $params 请求参数
 * @param int $post 请求方式
 * @param int $https https协议
 * @return bool|mixed
 */

class HstcmsCurl {

	public $userAgent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36';
	public $url = '';
	public $cookie = '';
	public $cookiePath = '';
	public $cookieContent = '';
	public $cookieData = [];
	public $cookieDatas = [];
	public $https = false;
	public $debug = false;
	public $httpCode = 200;
	public $httpInfo = array();
	public $response = '';

    public function __construct()
    {
        if(!function_exists('curl_init')){
        	logger('no curl');
        }
    }

	public function setParams($params = array())
	{
        if ($params && is_array($params)) {
            $params = http_build_query($params);
            if(strpos($this->url, '?') !== false) {
            	$this->url .= '&' . $params;
            } else {
            	$this->url .= '?' . $params;
            }
        }
	}

    public function get($params = array())
    {
    	$this->setParams($params);
    	return $this->curl($this->url);
    }

    public function post($postData = array(), $params = array())
    {
    	$this->setParams($params);
    	return $this->curl($this->url, $postData);
    }

    public function curl($url, $postData = array())
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($postData) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        if($this->cookie === 2 || $this->cookie === 3) {
        	$this->cookie('get');
        	if($this->cookieContent) {
        		curl_setopt($ch, CURLOPT_COOKIE, $this->cookieContent);
        	}
        }
        if($this->cookie === 1 || $this->cookie === 3) {
        	curl_setopt($ch, CURLOPT_HEADER, true); //将头文件的信息作为数据流输出
        }
        $this->response = curl_exec($ch);
        if ($this->response === FALSE) {
        	if($this->debug) {
        		echo "cURL Error: " . curl_error($ch);
        		logger("cURL Error: " . curl_error($ch));
        	}
            return false;
        }
        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        if($this->cookie === 1 || $this->cookie === 3) {
        	$this->cookie('save', $this->response);
        }
        curl_close($ch);
        return $this;
    }

    public function data($json = true)
    {
    	if($json){
    		return json_decode($this->response, true);
    	} else {
    		return $this->response;
    	}
    }

    public function cookie($type = 'save', $v = '', $v2 = '') 
    {
    	$parseUrl = parse_url($this->url);
    	$cacheName = md5($parseUrl['host']);
    	$cacheDataName = $parseUrl['host'].'data';
    	if($type == 'save') {
			preg_match_all('/Set-Cookie:(.*);/iU', $v, $cookies); //正则匹配
			if($cookies[1]) {
				foreach ($cookies[1] as $key => $value) {
					$values = explode('=', $value);
					$this->cookieData[trim($values[0])] = trim($values[1]);
				}
			}
    		Cache::forever($cacheDataName, $this->cookieData);
			//$this->cookieContent = implode(';', $cookies[1]);
    		//Cache::forever($cacheName, $this->cookieContent);
    	} else if($type == 'add') {
    		$this->cookieDatas[$v] = $v2;
    	} else if($type == 'get') {
    		$this->cookieData = Cache::get($cacheDataName);
    		if($this->cookieDatas) {
    			$this->cookieData = array_merge($this->cookieData, $this->cookieDatas);
    		}
    		$cookieContent = '';
    		foreach ($this->cookieData as $key => $value) {
    			 $cookieContent .= $key.'='.$value.';';
    		}
    		if(!$this->cookieContent){
    			//$this->cookieContent = Cache::get($cacheName);
    			$this->cookieContent = trim($cookieContent, ';');
    		}
    		if($v) {
    			return isset($this->cookieData[$v]) ? $this->cookieData[$v]: '';
    		}
    	}
    	return $this;
    }

    public function getHttpInfo($k = '')
    {
    	if($k) {
    		return isset($this->httpInfo[$k]) ? $this->httpInfo[$k] : '';
    	}
    	return isset($this->httpInfo[$k]) ? $this->httpInfo[$k] : [];
    }
}