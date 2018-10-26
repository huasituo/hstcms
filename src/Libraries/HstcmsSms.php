<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Model\CommonSmsModel;
use Huasituo\Hstcms\Model\CommonSmsCodeModel;

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
			return hst_message(hst_lang('hstcms::manage.sms.plat.choose.error'));
		}
		$smsLog = CommonSmsModel::where('id', $id)->select('id', 'rtype', 'requestid', 'status')->first();
		if(!$smsLog) {
			return hst_message(hst_lang('hstcms::manage.sms.log.no.error'));
		}
		if(!$smsLog['requestid']) {
			return hst_message(hst_lang('hstcms::manage.sms.log.no.error'));
		}
		if($smsLog['status'] == 3) {
			return true;
		}
		$result = $this->plat->getStatus($smsLog['rtype'], $smsLog['requestid']);
		if (hst_message_verify($result)) {
			return $result;
		}
		CommonSmsModel::where('id', $id)->update(['jstimes'=>$result['res']['jstimes'], 'stimes'=>$result['res']['times'], 'status'=>$result['res']['status']]);
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
			return hst_message(hst_lang('hstcms::manage.sms.plat.choose.error'));
		}
		$this->type = CommonSmsModel::getType($type);
		if (!$this->type) {
			return hst_message(hst_lang('hstcms::manage.sms.plat.choose.error'));
		}
		$code = CommonSmsCodeModel::_buildCode();
		$content = $this->_buildContent($code, $type);
		$number = $this->checkTodayNum($mobile, $type);
		if (hst_message_verify($number)) {
			return $number;
		}
		$param['code'] = $code;
		$param['product'] = hst_config('sms', 'product');
		$result = $this->plat->sendMobileMessage($mobile, $content, $param);
		if (hst_message_verify($result)) {
			return $result;
		}
		$results = CommonSmsCodeModel::addInfo($mobile, $type, $code, $number);
		if($results) {
			CommonSmsModel::addInfo($mobile, $type, $code, $content, json_encode($param), (int)$result['res']['type'], $result['res']['requestid'], $uid);
		}
		return true;
	}

	/**
	 * 验证验证码
	 * 
	 */
	public function checkVerify($mobile, $inputCode, $type = 'register') 
	{
		if (!$mobile || !$inputCode) return hst_message(hst_lang('hstcms::public.mobile.code.mobile.empty'));
		$info = CommonSmsCodeModel::where('type', $type)->where('mobile', $mobile)->first();
		if (!$info) return hst_message(hst_lang('hstcms::public.mobile.code.error'));
		if ($info['expired_time'] < hst_time()) return hst_message(hst_lang('hstcms::public.mobile.code.expired_time.error'));
		if ($inputCode !== $info['code']) return hst_message(hst_lang('hstcms::public.mobile.code.error'));
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
			return hst_message(hst_lang('hstcms::public.mobile.code.send.num.error'));
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

	public function setPlat() 
	{
		$plat = hst_config('sms', 'platform');
        $this->platforms = CommonSmsModel::getPlatform($plat);	
        if(class_exists($this->platforms['components'])) {
			$this->plat = new $this->platforms['components']();
		}
	}
}

