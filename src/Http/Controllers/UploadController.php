<?php

namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Http\Controllers\GlobalBasicController as BaseController;
use Huasituo\Hstcms\Libraries\HstcmsUpload;
use Huasituo\Hstcms\Libraries\HstcmsStorage;
use Illuminate\Http\Request;
/**
* 
*/
class UploadController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Request $request)
    {
        $file = $request->file('filedata');
        $upapp = $request->get('upapp');
        $hstcmsUpload = new HstcmsUpload();
        if($upapp) {
            $hstcmsUpload->app = $upapp;
        }
        $hstcmsUploads = $hstcmsUpload->setFile($file);
        if (hst_message_verify($hstcmsUploads) ) return $this->showError($hstcmsUploads['message']);
        $hstcmsUploads->doSave();
        $data = $hstcmsUploads->getData();
        $this->viewData['data'] = $data;
        return $this->showMessage('success');
    }
}