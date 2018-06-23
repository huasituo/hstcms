<?php
/**
 * @author huasituo <info@huasituo.com>
 * @copyright ©2016-2100 huasituo.com
 * @license http://www.huasituo.com
 */
namespace Huasituo\Hstcms\Libraries\Fields;
use Illuminate\Http\Request;
use Huasituo\Hstcms\Model\CommonFieldsModel;

class DateTime extends FieldAbs 
{
	
	/**
     * 构造函数 **
     */
    public function __construct()
    {
		parent::__construct();
		$this->name = hst_lang('hstcms::fields.date.time'); // 字段名称
		$this->fieldtype = array(
			'INT' => 10
		); // TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... )
		$this->defaulttype = 'INT'; // 当用户没有选择字段类型时的缺省值
    }
	
	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) 
	{
		$option['width'] = isset($option['width']) ? $option['width'] : 150;
		$option['format'] = isset($option['format']) ? $option['format'] : '';
		$option['value'] = isset($option['value']) ? $option['value'] : '';
		$option['fvalue'] = isset($option['fvalue']) ? $option['fvalue'] : '';
		$option['fieldtype'] = isset($option['fieldtype']) ? $option['fieldtype'] : "INT";
		$option['fieldlength'] = isset($option['fieldlength']) ? $option['fieldlength'] : "10";
		return '
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::public.width').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][width]" value="'.$option['width'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="'.hst_lang('hstcms::manage.fields.type.width.tips').'">'.hst_lang('hstcms::manage.fields.type.width.tips').'</div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::fields.date.time.geshi').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][format]" value="'.$option['format'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="'.hst_lang('hstcms::fields.date.time.geshi.tips').'">'.hst_lang('hstcms::fields.date.time.geshi.tips').'</div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::public.default.value').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][value]" value="'.$option['value'].'" class="hstui-input hstui-length-5 J_datetime">
	            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="'.hst_lang('hstcms::manage.fields.default.value.001.tips').'">'.hst_lang('hstcms::manage.fields.default.value.001.tips').'</div>
	          </div>
	        </div>
                <script>
                //日期+时间选择器
                Hstui.use(\'jquery\',function(){
					var dateTimeInput = $("input.J_datetime");
					if(dateTimeInput.length) {
						Hstui.use(\'datePicker\',function() {
							dateTimeInput.datePicker({time:true});
						});
					}
                });
                </script>
				'.$this->field_type($option['fieldtype'], $option['fieldlength'], $option['fvalue']);
	}

	/**
	 * 字段表单输入
	 *
	 * @param	string	$cname	字段别名
	 * @param	string	$name	字段名称
	 * @param	array	$cfg	字段配置
	 * @param	string	$value	值
	 * @return  string
	 */

	public function input($cname, $name, $cfg, $value = NULL, $id = 0) 
	{
		// 字段显示名称
		$text = (isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? '<font color="red">*</font> ' : '').$cname.'';
		// 表单宽度设置
		$width = isset($cfg['option']['width']) && $cfg['option']['width'] ? $cfg['option']['width'] : '150';
		$width = 'style="width:'.$width.(is_numeric($width) ? 'px' : '').';"';
		// 表单附加参数
		$attr = isset($cfg['validate']['formattr']) && $cfg['validate']['formattr'] ? $cfg['validate']['formattr'] : '';
		// 字段提示信息
		$tips = isset($cfg['validate']['tips']) && $cfg['validate']['tips'] ? $cfg['validate']['tips'] : '';
		// 字段默认值
		if (!$value) {
			if(isset($cfg['option']['value']) && is_numeric($cfg['option']['value'])) {
				$value = isset($cfg['option']['value']) && (int)$cfg['option']['value'] === '0' ? 0 : hst_time();
			} else if(isset($cfg['option']['value']) && !is_numeric($cfg['option']['value'])) {
				$value = hst_str2time($cfg['option']['value']);
			}
		} else {
			$value = $value ? $value : (strlen($value) == 1 && $value == 0 ? '' : hst_time());
		}
		$format = isset($cfg['option']['format']) && $cfg['option']['format'] ? $cfg['option']['format'] : 'Y-m-d H:i';
		$show = $value ? hst_time2str($value, $format) : '';
		
		$disabled = !$this->isadmin && $id && $value && isset($cfg['validate']['isedit']) && !$cfg['validate']['isedit'] ? ' disabled' : ' ';
		$required = isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? ' required="required"' : '';
		$str = '';
		$str.= '<input type="text" class="hstui-input J_datetime" value="'.$show.'" name="'.$name.'" id="hstcms_'.$name.'" ' . $width . $disabled . $attr.$required.' />';
        if ($name == 'updatetime') {

        }
		return $this->input_format($name, $text, $str, $tips);
	}
	
	/**
	 * 字段输出
	 */
	public function output_data($data, $field = [])  
	{
		if(!isset($data[$field['fieldname']])) {
			return $data;
		}
		$value = $data[$field['fieldname']];
		if(!$value) {
			return $data;
		}
		$data['_'.$field['fieldname']] = $value;
		$format = isset($cfg['option']['format']) && $cfg['option']['format'] ? $cfg['option']['format'] : 'Y-m-d H:i';
		$data[$field['fieldname']] = hst_time2str($value, $format);
		return $data;
	}
}