<?php 
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Http\Controllers\Manage;

use Huasituo\Hstcms\Model\AttachmentModel;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class AttachmentController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'index'=>['name'=>hst_lang('hstcms::manage.attach.setting'),'url'=>'manageAttach'],
        ];
    }

    public function index(Request $request)
    {
    	$config = hst_config('attachment');
        if(!isset($config['storage']) || !$config['storage']) {
            $config['storage'] = 'public';
        }
        $storages = AttachmentModel::getStorages();
        $this->viewData['navs'] = $this->getNavs('index');
        !($post_max_size = ini_get('post_max_size')) && $post_max_size = '2M';
        !($upload_max_filesize = ini_get('upload_max_filesize')) && $upload_max_filesize = '2M';
        $maxSize = min($post_max_size, $upload_max_filesize);
    	return $this->loadTemplate('attachment.index', [
            'config'=>$config, 
            'storages'=>$storages,
            'maxSize'=>$maxSize
        ]);
    }

    public function save(Request $request)
    {
        $arrRequest = $request->all();
        $_extsize = array();
        if(isset($arrRequest['extsize']) && $arrRequest['extsize']) {
            foreach ($arrRequest['extsize'] as $key => $value) 
            {
                if (!empty($value['ext'])) $_extsize[$value['ext']] = abs(intval($value['size']));
            }
        }
        $arrRequest['storage'] = $arrRequest['storage'] ? $arrRequest['storage'] : 'public';
        $arrRequest['dirs'] = $arrRequest['dirs'] ? $arrRequest['dirs'] : 'ymd';
        $data =[
            ['name'=>'extsize', 'value'=>$_extsize, 'issystem'=>1],
            ['name'=>'storage', 'value'=>$arrRequest['storage'] ? trim($arrRequest['storage']) : 'public'],
            ['name'=>'dirs', 'value'=>trim($arrRequest['dirs'])]
        ];
        $configData = [
            'FILESYSTEM_DEFAULT' => $arrRequest['storage']
        ];

        $oldConfig = hst_config('attachment');
        hst_save_config('attachment', $data);
        hst_updateEnvInfo($configData);
        $this->addOperationLog(hst_lang('hstcms::manage.attach.setting'),'', hst_config('attachment'), $oldConfig);
        return $this->showMessage('hstcms::public.save.success');
    }

}
