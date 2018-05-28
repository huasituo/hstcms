<?php

namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Model\AttachmentModel;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Util\MimeType;
use Illuminate\Support\Facades\DB;

/**
* 
*/
class HstcmsStorage
{

	public $aid = 0;
	public $file = '';
	public $name = '';
	public $headers = [];

    public $disks = 'public';

	public function __construct() 
    {
		self::setStorage();
	}

    public function setStorage($disks = '')
    {
        if($disks) {
        	$this->disks = $disks;
            return $this;
        }
        $this->disks = hst_config('attachment', 'storage');
    }

    public function download() 
    {
    	if($this->aid) {
    		$attachInfo = AttachmentModel::where('aid', $this->aid)->first();
    		if(!$attachInfo) {
    			return hst_message('hstcms::public.download.file.error.001');
    		}
    		$name = $this->name ? $this->name : $attachInfo['name'];
    		$disk = $attachInfo['disk'] ? $attachInfo['disk'] : $this->disks;
    		if(!Storage::disk($disk)->exists($attachInfo['path'])) {
    			return hst_message('hstcms::public.download.file.error.001');
    		}
    		return Storage::disk($disk)->download($attachInfo['path'], '中国.txt', $this->headers);
    	} else {
    		if(!$this->file) {
    			return hst_message('hstcms::public.download.file.error.001');
    		}
    		if(!Storage::disk($this->disks)->exists($this->file)) {
    			return hst_message('hstcms::public.download.file.error.001');
    		}
    		return Storage::disk($disk)->download($this->file, $this->name, $this->headers);
    	}
    }

    public function delete($file) 
    {	
    	return Storage::disk($this->disk)->delete($file);
    }


}