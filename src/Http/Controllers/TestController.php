<?php

namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Libraries\Sms;

use Huasituo\Hstcms\Libraries\HstcmsError;
use Huasituo\Hstcms\Libraries\HstcmsUpload;

use Illuminate\Http\Request;
/**
* 
*/
class TestController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request) 
    {
    	$Sms = new Sms();

    	//$result = $Sms->sendMobileMessage('18664597716', 'register');
		//$result = $Sms->checkVerify('18664597716', '931298s', 'register');
		//if ($result instanceof HstError) return $this->showError($result->getError());
		//echo 'verify success';
    	//$this->showError('test');
        return $this->loadTemplate('hstcms::test');
    }

    public function pindex(Request $request)
    {
        $file = $request->file('image');
        $HstcmsUpload = new HstcmsUpload();
        $HstcmsUploads = $HstcmsUpload->setFile($file);
        if ($HstcmsUploads instanceof HstcmsError) return $this->showError($HstcmsUploads->getError());
        print_r($HstcmsUploads);
        $HstcmsUploads->doSave();
        $data = $HstcmsUploads->getData();
        print_r($data);
    }
}