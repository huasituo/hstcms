<?php
use Huasituo\Hstcms\Libraries\HstcmsStorage;
use Huasituo\Hstcms\Model\AttachmentModel;
use Illuminate\Support\Facades\Storage;

if ( ! function_exists('hst_storage_url'))
{    
    function hst_storage_url($v = '', $disk = '')
    {
    	if(is_numeric($v)) {
    		$attachInfo = AttachmentModel::where('aid', $v)->first();
    		if(!$attachInfo) {
    			return '';
    		}
    		return storage::disk($attachInfo['disk'])->url($attachInfo['path']);
    	} else {
    		if(!$disk) {
    			$disks = hst_config('attachment', 'storage');
    		}
    		return storage::disk($disk)->url($v);
    	}
    }
}

if ( ! function_exists('hst_storage_delete'))
{    
    function hst_storage_delete($v = '', $disk = '')
    {
    	if(is_numeric($v)) {
    		return AttachmentModel::deleteAttach($v);
    	} else {
            $hstcmsStorage = new HstcmsStorage();
    		if($disk) {
            	$hstcmsStorage->disk = $disk;
    		}
    		return $hstcmsStorage->delete($v);
    	}
    }
}

if ( ! function_exists('hst_storage_download'))
{    
    function hst_storage_download($v = '', $disk = '')
    {
        $hstcmsStorage = new HstcmsStorage();
        if(is_numeric($v)) {
            $hstcmsStorage->aid = $v;
        } else {
            if($disk) {
                $hstcmsStorage->disk = $disk;
            }
        }
        $result = $hstcmsStorage->download();
        if(hst_message_verify($result)) {
            return $this->showError($result['message']);
        }
        return $result;
    }
}
