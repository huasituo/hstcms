<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers;

use Huasituo\Hstcms\Http\Controllers\GlobalBasicController as BaseController;
use Huasituo\Hstcms\Libraries\HstcmsUpload;
use Huasituo\Hstcms\Libraries\HstcmsStorage;
use Huasituo\Hstcms\Model\AttachmentModel;
use Illuminate\Http\Request;
use Auth;

/**
* 
*/
class UploadController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function save(Request $request)
    {
        $file = $request->file('filedata');
        $upapp = $request->get('upapp');
        $dir = $request->get('dir');
        $aid = (int)$request->get('aid');
        $name = (string)$request->get('name');
        $tempid = (string)$request->get('tempid');
        $islogin = (int)$request->get('islogin');
        $uid = (int)$request->get('uid');
        if($islogin) {
            $uid = Auth::id();
        }
        $hstcmsUpload = new HstcmsUpload();
        if($upapp) {
            $hstcmsUpload->app = $upapp;
        }
        $hstcmsUploads = $hstcmsUpload->setFile($file);
        if (hst_message_verify($hstcmsUploads) ) return $this->showError($hstcmsUploads['message']);
        if($dir) {
            $hstcmsUploads->setDirs($dir);
        }
        if($uid) {
            $hstcmsUploads->setUid($uid);
        }
        if($aid) {
            $attachInfo = AttachmentModel::getAttach($aid);
            if($attachInfo) {
                $name = basename($attachInfo['path'], ".".$attachInfo['type']);
            }
            $hstcmsUploads->setAid($aid);
        }
        if($name) {
            $hstcmsUploads->setFileName($name);
        }
        if($tempid) {
            $hstcmsUploads->setTempId($tempid);
        }
        $hstcmsUploads->doSave();
        $data = $hstcmsUploads->getData();
        $this->viewData['data'] = $data;
        return $this->showMessage('success');
    }

    public function imageSave(Request $request)
    {
        $file = $request->file('filedata');
        $upapp = $request->get('upapp');
        $dir = $request->get('dir');
        $aid = (int)$request->get('aid');
        $name = (string)$request->get('name');
        $tempid = (string)$request->get('tempid');
        $islogin = (int)$request->get('islogin');
        $uid = (int)$request->get('uid');
        if($islogin) {
            $uid = Auth::id();
        }
        $hstcmsUpload = new HstcmsUpload();
        if($upapp) {
            $hstcmsUpload->app = $upapp;
        }
        $hstcmsUploads = $hstcmsUpload->setFile($file);
        if (hst_message_verify($hstcmsUploads) ) return $this->showError($hstcmsUploads['message']);
        if($dir) {
            $hstcmsUploads->setDirs($dir);
        }
        if($uid) {
            $hstcmsUploads->setUid($uid);
        }
        if($aid) {
            $attachInfo = AttachmentModel::getAttach($aid);
            if($attachInfo) {
                $name = basename($attachInfo['path'], ".".$attachInfo['type']);
            }
            $hstcmsUploads->setAid($aid);
        }
        if($name) {
            $hstcmsUploads->setFileName($name);
        }
        if($tempid) {
            $hstcmsUploads->setTempId($tempid);
        }
        $hstcmsUploads->doSave();
        $data = $hstcmsUploads->getData();
        $this->viewData['data'] = $data;
        return $this->showMessage('success');
    }
}