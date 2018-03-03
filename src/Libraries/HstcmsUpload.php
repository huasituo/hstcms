<?php

namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Model\AttachmentModel;

use League\Flysystem\Util\MimeType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
/**
* 
*/
class HstcmsUpload
{
	public $storages = [];
	public $saveDir = '';
	public $allowExtsizes = [];
	public $app = 'system';

	public $fileName = '';
	public $fileSize = 0;
	public $extension = '';
	public $clientName = '';
	public $file = '';

	public function __construct() {
		self::setStorage();
	}

	public function  setFile($file) 
	{
		if(!$file) {
			return new HstcmsError('no file');
		}
		$attachmentConfig = hst_config('attachment');
		$this->file = $file;
		$this->extension = $file->getClientOriginalExtension();
		$this->fileSize = $file->getClientSize();
        $this->clientName = $file->getClientOriginalName();
        $extsizes = array_keys($attachmentConfig['extsize']);
        //判断文件上传过程中是否出错
        if ($file->isValid()) {
            $mimeType = MimeType::getExtensionToMimeTypeMap();
            if (!empty($extsizes)) {
                if (!in_array($this->extension, $extsizes)) {
                    return new HstcmsError('hstcms::public.file.type.is.not.allowed.to.upload');
                }
            }
            if (isset($this->allowExtension) && $this->allowExtension) {
                foreach ($this->allowExtension as $item) {
                    if (!in_array(FileClass::getMimeTypeByExtension($item), $mimeType)) {
                    	return new HstcmsError('hstcms::public.file.type.is.not.allowed.to.upload');
                    }
                }
            }
            if (!in_array($file->getMimeType(), $mimeType)) {
                return new HstcmsError('hstcms::public.unknown.file.type');
            }
            $attachmentConfig['extsize'][$this->extension] = isset($attachmentConfig['extsize'][$this->extension]) ? $attachmentConfig['extsize'][$this->extension] : 2048;
            if ($this->fileSize > $file->getMaxFilesize() || $this->fileSize > $attachmentConfig['extsize'][$this->extension] * 1024) {
                return new HstcmsError('hstcms::public.upload.files.beyond.the server.size.limit');
            }
			$this->setDirs();
			$this->setFileName();
			return $this;
        }
        return new HstcmsError('hstcms::public.upload.error');
	}

	public function setExtsize($allowExtsizes = []) 
	{
		$this->allowExtsizes = $allowExtsizes;
		return $this;
	}

	public function setDirs($dir = '') 
	{
		if($dir) {
			$this->saveDir = $dir;
			return $this;
		}
		$attachmentConfig = hst_config('attachment');
        $storagedir = isset($attachmentConfig['dirs']) ? $attachmentConfig['dirs'] : 'ymd';
        $timedir = '';
        switch ($storagedir) {
            case 'y':
                $timedir = hst_time2str(hst_time(), 'Y');
                break;
            case 'ym':
                $timedir = hst_time2str(hst_time(), 'Y/m');
                break;
            default:
                $timedir = hst_time2str(hst_time(), 'Y/m/d');
                break;
        }
        $this->saveDir = $timedir;
		return $this;
	}

	public function setFileName() 
	{
        $this->fileName = md5((substr($this->clientName, 0, (strlen($this->clientName) - strlen($this->extension) - 1))) . time()) . '.' . $this->extension;
		return $this;
	}

	public function setStorage() 
	{
		$storage = hst_config('attachment', 'storage');
        $this->storages = AttachmentModel::getStorages($storage);
	}

	public function doSave() 
	{
        //判断文件上传过程中是否出错
        if ($this->file->isValid()) {
	        $status = Storage::disk($this->storages['alias'])->put($this->saveDir . '/' . $this->fileName, file_get_contents($this->file->getRealPath()));
	        if($status) {
	        	return true;
	        }
        }
        return new HstcmsError('hstcms::public.upload.error');
	}

	public function getData ()
	{
    	$postData = [
    		'name'=>$this->clientName,
    		'type'=>$this->extension,
    		'size'=>$this->fileSize,
    		'path'=>$this->saveDir . $this->fileName,
    		'ifthumb'=>0,
    		'created_userid'=>0,
    		'created_time'=>hst_time(),
    		'app'=>$this->app,
    		'app_id'=>0,
    		'descrip'=>'',
    		'disk'=>$this->storages['alias']
    	];
    	$aid = AttachmentModel::insertGetId($postData);
    	$data = [
    		'name'=>$this->clientName,
    		'fileName'=>$this->fileName,
    		'type'=>$this->extension,
    		'size'=>$this->fileSize,
    		'path'=>$this->saveDir. '/'. $this->fileName,
    		'ifthumb'=>0,
    		'aid'=>$aid,
    		'descrip'=>'',
    	];
    	return $data;
	}

}
