<?php
namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Libraries\HuasituoSmsApi;
use Huasituo\Hstcms\Libraries\HuasituoApi\ApiBase;
use Huasituo\Hstcms\Libraries\HuasituoApi\Requests\HuasituoApiSmsRequests;
/**
* 
*/
class HstcmsSmsApi
{
	protected $smsConfig = [];

	protected $HuasituoSmsApi;

	public function __construct($config = []) 
	{
		$this->smsConfig = hst_config('sms');
		$this->HuasituoSmsApi = new ApiBase();

		$this->HuasituoSmsApi->appId = $this->smsConfig['hstsmsappid'];
		$this->HuasituoSmsApi->secretKey = $this->smsConfig['hstsmskey'];

		if(isset($config['appId'])) {
			$this->HuasituoSmsApi->appId = $config['appId'];
		}

		if(isset($config['secretKey'])) {
			$this->HuasituoSmsApi->secretKey = $config['secretKey'];
		}

		if(isset($config['signId'])) {
			$this->smsConfig['hstsmssign'] = $config['signId'];
		}
		$this->HuasituoSmsApi->rsaPublicKey = '';
		$this->HuasituoSmsApi->rsaPrivateKey = '';
		$this->HuasituoSmsApi->signType = 'MD5';
	}

	public function sendMobileMessage($mobile, $content, $param = []) 
	{
		$request = new HuasituoApiSmsRequests($this->HuasituoSmsApi);
		$request->setSignid($this->smsConfig['hstsmssign']);
		$request->setTplid($content);
		$request->setMobile($mobile);
		$request->setParam($param);
		$request->sendMessage();
		$result = $this->HuasituoSmsApi->execute($request);
		if($result['state'] != 0) {
			return ['state'=>'error', 'message'=>$result['message']];
		}
		return $result;
	}

	public function getSurplus() 
	{
		$request = new HuasituoApiSmsRequests($this->HuasituoSmsApi);
		$request->getSurplus();
		$result = $this->HuasituoSmsApi->execute($request);
		return $result;
	}

	public function getPay($money, $note = '') 
	{
		$request = new HuasituoApiSmsRequests($this->HuasituoSmsApi);
		$request->setAmount($money);
		$request->pay();
		$result = $this->HuasituoSmsApi->execute($request, true);
		return $result;
	}

	public function getStatus($rtype, $requestid = '') 
	{
		$request = new HuasituoApiSmsRequests($this->HuasituoSmsApi);
		$request->setId($requestid);
		$request->setType($rtype);
		$request->getStatus();
		$result = $this->HuasituoSmsApi->execute($request);
		if($result['state'] != 0) {
			return ['state'=>'error', 'message'=>$result['message']];
		}
		return $result;
	}

}

