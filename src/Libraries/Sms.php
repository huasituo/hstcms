<?php

namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Model\CommonSmsModel;
use Huasituo\Hstcms\Model\CommonSmsCodeModel;
/**
* 
*/
class Sms
{
	public $platforms = [];
	public $plat;
	public $type = [];

	public function __construct() {
		$this->setPlat();
	}
	
	/**
	 * 发送短信
	 *
	 * @return bool
	 */
	public function sendMobileMessage($mobile, $type, $param = []) {
		if (!$this->plat) {
			return new HstcmsError('USER:mobile.plat.choose.error');
		}
		$this->type = CommonSmsModel::getType($type);	
		if (!$this->type) {
			return new HstcmsError('USER:mobile.plat.choose.error');
		}
		$code = CommonSmsCodeModel::_buildCode();
		$content = $this->_buildContent($code, $type);
		$number = $this->checkTodayNum($mobile);
		if ($number instanceof HstcmsError) {
			return $number;
		}
		$param['code'] = $code;
		$param['product'] = hst_config('sms', 'product');
		$result = $this->plat->sendMobileMessage($mobile, $content, $param);
		if ($result instanceof HstcmsError) return $result;
		$result = CommonSmsCodeModel::addInfo($mobile, $type, $code, $number);
		if($result) {
			CommonSmsModel::addInfo($mobile, $type, $code, $content, json_encode($param));
		}
		return true;
	}

	/**
	 * 验证验证码
	 * 
	 */
	public function checkVerify($mobile, $inputCode, $type = 'register') {
		if (!$mobile || !$inputCode) return new HstcmsError('hstcms::public.mobile.code.mobile.empty');
		$info = CommonSmsCodeModel::where('type', $type)->where('mobile', $mobile)->first();
		if (!$info) return new HstcmsError('hstcms::public.mobile.code.error');
		if ($info['expired_time'] < hst_time()) return new HstcmsError('hstcms::public.mobile.code.expired_time.error');
		if ($inputCode !== $info['code']) return new HstcmsError('hstcms::public.mobile.code.error');
		// 手机验证通过后扩展
		return true;
	}

	public function checkTodayNum($mobile, $type = 'register') {
		$info = CommonSmsCodeModel::where('type', $type)->where('mobile', $mobile)->first();
		$number = 1;
		$tdtime = hst_getTdtime();
		if ($info) 
		{
			$number = $info['number'];
			if ($info['create_time'] < $tdtime + 86400 && $info['create_time'] > $tdtime) {
				$number++;
			} else {
				$number = 1;
			}
		}
		if ($number > $this->type['num']) {
			return new HstcmsError('Hstcms::public.mobile.code.send.num.error');
		}
		return $number;
	}

	protected function _buildContent($code, $type = 'register') 
	{
		$content = hst_config('sms', 'types');
		$search = array('{code}', '{product}');
		$replace = array($code, hst_config('sms', 'product'));
		$content = str_replace($search, $replace, $content[$type]['content']);
		return $content;
	}

	public function setPlat() {
		$plat = hst_config('sms', 'platform');
        $this->platforms = CommonSmsModel::getPlatform($plat);	
        if(class_exists($this->platforms['components'])) {
			$this->plat = new $this->platforms['components']();
		}
	}

}

