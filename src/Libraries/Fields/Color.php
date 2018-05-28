<?php 
namespace Huasituo\Hstcms\Libraries\Fields;

/**
 *
 * @since		version 1.0.0
 * @author		Huasituo <info@huasituo.com>
 * @license     http://www.huasituo.com/license
 * @copyright   Copyright (c) 2014 - 9999, huasituo.Com, Inc.
 */
class Color extends FieldAbs {
	
	/**
     * 构造函数 颜色选择 **
     */
    public function __construct() 
    {
		parent::__construct();
		$this->name = hst_lang('hstcms::public.color'); // 字段名称
		$this->fieldtype = array(
			'VARCHAR' => 10
		); // TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... )
		$this->defaulttype = 'VARCHAR'; // 当用户没有选择字段类型时的缺省值
    }
	
	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) {
		$option['value'] = isset($option['value']) ? $option['value'] : '';
		$option['fvalue'] = isset($option['fvalue']) ? $option['fvalue'] : '';
		$option['fieldtype'] = isset($option['fieldtype']) ? $option['fieldtype'] : "VARCHAR";
		$option['fieldlength'] = isset($option['fieldlength']) ? $option['fieldlength'] : "10";
		return '
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::public.default.value').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	            <span class="hstui-color-pick J_color_pick hstui-mr-sm hstui-fl"><em style="background:'.$option['value'].';" class="J_bg"></em></span>
	              <input type="hidden" class="J_hidden_color" name="setting[option][value]" value="'.$option['value'].'" >
	            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="'.hst_lang('hstcms::manage.fields.default.value.001.tips').'">'.hst_lang('hstcms::manage.fields.default.value.001.tips').'</div>
	          </div>
	        </div>
                <script>
                	//拾色器
					var color_pick = $(\'.J_color_pick\');
					if(color_pick.length) {
						Hstui.use(\'colorPicker\',function() {
							color_pick.each(function() {
								$(this).colorPicker({
									default_color : \'url("\'+ G.RES_ROOT +\'/images/transparent.png")\',		//写死
									callback:function(color) {
										var em = $(this).find(\'em\'),
											input = $(this).next(\'.J_hidden_color\');
											em.css(\'background\',  color);
										input.val(color.length === 7 ? color : \'\');
									}
								});
							});
						});
					}
                </script>
				'.$this->field_type($option['fieldtype'], $option['fieldlength'], $option['fvalue']);
	}
	
	/**
	 * 字段输出
	 */
	public function output($value, $cfg = []) 
	{
		return $value;
	}
	
    /**
     * 字段入库值
     *
     * @param	array	$field	字段信息
     * @return  void
     */
    public function insert_value($value, $field = [])
    {
    	return $value;
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
		$cfg['option']['value'] = isset($cfg['option']['value']) ? $cfg['option']['value'] : "";
		// 字段显示名称
		$text = (isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? '<font color="red">*</font>&nbsp;' : '').$cname;
		// 表单附加参数
		$attr = isset($cfg['validate']['formattr']) && $cfg['validate']['formattr'] ? $cfg['validate']['formattr'] : '';
		// 字段提示信息
		$tips = isset($cfg['validate']['tips']) && $cfg['validate']['tips'] ? $cfg['validate']['tips']: '';
		// 字段默认值
		$value = $value ? $value : $cfg['option']['value'];
		$str = '';
		$str .= '<span class="hstui-color-pick J_color_pick"><em style="background:'.$value.';" class="J_bg"></em></span><input type="hidden" name="'.$name.'" class="J_hidden_color" id="hstcms_'.$name.'" value="' . $value . '" />';
		return $this->input_format($name, $text, $str, $tips);
	}
	
}