<?php

namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Model\CommonSmsModel;
use Huasituo\Hstcms\Model\CommonSmsCodeModel;
/**
* 
*/
class HstcmsSms
{
	public $platforms = [];
	public $plat;
	public $type = [];

	public function __construct()
	{
		$this->setPlat();
	}

	public function getStatus($id = 0) 
	{
		if (!$this->plat) {
			return ['state'=>'error', 'message'=>hst_lang('hstcms::manage.sms.plat.choose.error')];
		}
		$smsLog = CommonSmsModel::where('id', $id)->select('id', 'rtype', 'requestid', 'status')->first();
		if(!$smsLog) {
			return ['state'=>'error', 'message'=>hst_lang('hstcms::manage.sms.log.no.error')];
		}
		if(!$smsLog['requestid']) {
			return ['state'=>'error', 'message'=>hst_lang('hstcms::manage.sms.log.no.error')];
		}
		if($smsLog['status'] == 3) {
			return true;
		}
		$result = $this->plat->getStatus($smsLog['rtype'], $smsLog['requestid']);
		if (isset($result['state']) && $result['state'] === 'error') {
			return $result;
		}
		CommonSmsModel::where('id', $id)->update(['jstimes'=>$result['data']['jstimes'], 'stimes'=>$result['data']['times'], 'status'=>$result['data']['status']]);
		return true;
	}
	
	/**
	 * 发送短信
	 *
	 * @return bool
	 */
	public function sendMobileMessage($mobile, $type, $param = [], $uid = 0) 
	{
		if (!$this->plat) {
			return ['state'=>'error', 'message'=>hst_lang('hstcms::manage.sms.plat.choose.error')];
		}
		$this->type = CommonSmsModel::getType($type);
		if (!$this->type) {
			return ['state'=>'error', 'message'=>hst_lang('hstcms::manage.sms.plat.choose.error')];
		}
		$code = CommonSmsCodeModel::_buildCode();
		$content = $this->_buildContent($code, $type);
		$number = $this->checkTodayNum($mobile, $type);
		if (isset($number['state']) && $number['state'] == 'error') {
			return $number;
		}
		$param['code'] = $code;
		$param['product'] = hst_config('sms', 'product');
		$result = $this->plat->sendMobileMessage($mobile, $content, $param);
		if (isset($result['state']) && $result['state'] === 'error') {
			return $result;
		}
		$results = CommonSmsCodeModel::addInfo($mobile, $type, $code, $number);
		if($results) {
			CommonSmsModel::addInfo($mobile, $type, $code, $content, json_encode($param), (int)$result['data']['type'], $result['data']['requestid'], $uid);
		}
		return true;
	}

	/**
	 * 验证验证码
	 * 
	 */
	public function checkVerify($mobile, $inputCode, $type = 'register') 
	{
		if (!$mobile || !$inputCode) return ['state'=>'error', 'message'=>hst_lang('hstcms::public.mobile.code.mobile.empty')];
		$info = CommonSmsCodeModel::where('type', $type)->where('mobile', $mobile)->first();
		if (!$info) return ['state'=>'error', 'message'=>hst_lang('hstcms::public.mobile.code.error')];
		if ($info['expired_time'] < hst_time()) return ['state'=>'error', 'message'=>hst_lang('hstcms::public.mobile.code.expired_time.error')];
		if ($inputCode !== $info['code']) return ['state'=>'error', 'message'=>hst_lang('hstcms::public.mobile.code.error')];
		return true;
	}

	/**
	 * 检查发送次数
	 * 
	 */
	public function checkTodayNum($mobile, $type = 'register') 
	{
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
			return ['state'=>'error', 'message'=>hst_lang('hstcms::public.mobile.code.send.num.error')];
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

