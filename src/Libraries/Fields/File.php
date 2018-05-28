<?php 
namespace Huasituo\Hstcms\Libraries\Fields;

use Huasituo\Hstcms\Model\AttachmentModel;
/**
 * @since		version 1.0.0
 * @author		Huasituo <info@huasituo.com>
 * @license     http://www.huasituo.com/license
 * @copyright   Copyright (c) 2014 - 9999, huasituo.Com, Inc.
 */
class File extends FieldAbs 
{
	
	/**
     * 构造函数 单文件 **
     */
    public function __construct() 
    {
		parent::__construct();
		$this->name = hst_lang('hstcms::fields.file'); // 字段名称
		// TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... );
		$this->fieldtype = array('VARCHAR' => '255'); 
		$this->defaulttype = 'VARCHAR'; // 当用户没有选择字段类型时的缺省值
    }
	
	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) 
	{
		$option['fieldtype'] = isset($option['fieldtype']) ? $option['fieldtype'] : '';
		$option['fieldlength'] = isset($option['fieldlength']) ? $option['fieldlength'] : '';
		$option['uptips'] = isset($option['uptips']) ? $option['uptips'] : '';
		$option['fvalue'] = isset($option['fvalue']) ? $option['fvalue'] : '';
		$option['value'] = isset($option['value']) ? $option['value'] : '';
		$option['size'] = isset($option['size']) ? $option['size'] : '2048';
		$option['ext'] = isset($option['ext']) ? $option['ext'] : 'jpg,png,gif,jpeg';
		$option['upauto'] = isset($option['upauto']) ? $option['upauto'] : 1;
		$option['upapp'] = isset($option['upapp']) ? $option['upapp'] : '';
		$option['upbuttontext'] = isset($option['upbuttontext']) ? $option['upbuttontext'] : '选择图片';
		return '
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.file.size').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][size]" value="'.$option['size'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_size" data-tips="'.hst_lang('hstcms::fields.file.size.tips').'">'.hst_lang('hstcms::fields.file.size.tips').'</div>
	          </div>
	          </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.file.ext').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][ext]" value="'.$option['ext'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_ext" data-tips="'.hst_lang('hstcms::fields.file.ext.tips').'">'.hst_lang('hstcms::fields.file.ext.tips').'</div>
	          </div>
	        </div> 
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.file.upbuttontext').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][upbuttontext]" value="'.$option['upbuttontext'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_upbuttontext" data-tips="'.hst_lang('hstcms::fields.file.upbuttontext.tips').'">'.hst_lang('hstcms::fields.file.upbuttontext.tips').'</div>
	          </div>
	        </div> 
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.file.upapp').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][upapp]" value="'.$option['upapp'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_upapp" data-tips="'.hst_lang('hstcms::fields.file.upapp.tips').'">'.hst_lang('hstcms::fields.file.upapp.tips').'</div>
	          </div>
	        </div> 
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.file.uptips').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][uptips]" value="'.$option['uptips'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_uptips" data-tips="'.hst_lang('hstcms::fields.file.uptips.tips').'">'.hst_lang('hstcms::fields.file.uptips.tips').'</div>
	          </div>
	        </div> 
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.file.auto.upload').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
                <div class="hstui-mr-sm"><input type="radio" name="setting[option][upauto]" '.hst_ifCheck(!$option['upauto']).' value="0" />'.hst_lang('hstcms::public.no').'
                    <input type="radio" name="setting[option][upauto]" '.hst_ifCheck($option['upauto']).' value="1" />'.hst_lang('hstcms::public.yes').'</div>
	            <div class="hstui-form-input-tips" id="J_form_tips_upauto" data-tips="'.hst_lang('hstcms::fields.file.auto.upload.tips').'">'.hst_lang('hstcms::fields.file.auto.upload.tips').'</div>
	          </div>
	        </div>
                '.$this->field_type($option['fieldtype'], $option['fieldlength'], $option['fvalue']);
	}
	
	
	/**
	 * 字段入库值
	 */
    public function insert_value($value, $field)
	{
		if(!$value) {
			return 0;
		}
		return $value['aid'];
	}
	
	/**
	 * 字段输出
	 *
	 * @param	array	$value	数据库值
	 * @return  string
	 */
	public function output($value, $cfg = []) 
	{
		if(!$value) {
			return [];
		}
		$attachInfo = AttachmentModel::getAttach($value);
		return $attachInfo;
	}
	
	/**
	 * 字段表单输入
	 *
	 * @param	string	$cname	字段别名
	 * @param	string	$name	字段名称
	 * @param	array	$cfg	字段配置
	 * @param	array	$data	值
	 * @return  string
	 */
	public function input($cname, $name, $cfg, $value = NULL, $id = 0) 
	{
		$upauto = isset($cfg['option']['upauto']) ? $cfg['option']['upauto'] ? 'true' : 'false'  : 'true';
		$upbuttontext = isset($cfg['option']['upbuttontext']) ? $cfg['option']['upbuttontext'] : hst_lang('hstcms::fields.file.select.pic');
		$uptips = isset($cfg['option']['uptips']) ? $cfg['option']['uptips'] : '';
		$upapp = isset($cfg['option']['upapp']) ? $cfg['option']['upapp'] : '';
		// 是否必须
		$text = (isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? '<font color="red">*</font>&nbsp;' : '').$cname;
		// 字段提示信息
		$tips = isset($cfg['validate']['tips']) && $cfg['validate']['tips'] ? $cfg['validate']['tips'] : '';
		// 禁止修改
		$disabled = !$this->isadmin && $id && $value && isset($cfg['validate']['isedit']) && $cfg['validate']['isedit'] ? 'false' : 'true';
		$postDatas ='';
		$attachs = [];
		if ($value) {
			$attachInfo = AttachmentModel::getAttach($value);
			$attachs[0] = $attachInfo;
		}
		$attachs = json_encode($attachs);
		$uploadUrl = route('uploadSave');
		$str = '<div class="hstui-upload J_upload_'.$name.'" style="line-height: 20px;"></div>';
		$str .= "<script>
			Hstui.use('jquery', 'common', 'upload', function() {
				$(\".J_upload_$name\").hstuiUpload({
					autoUpload: $upauto,
					selectText: '$upbuttontext',
					multi: false,
					fileName: 'filedata',
					isedit: $disabled,
					dataList: $attachs,
					fName: '$name',
					queue: {
					},
					showNote: '$uptips',
					url: '$uploadUrl',
					formParam: {
						upapp:'$upapp'
					}
				})
			})
		</script>";
		return $this->input_format($name, $text, $str, $tips);
	}
}