<?php 
namespace Huasituo\Hstcms\Libraries\Fields;

/**
 * @since		version 1.0.0
 * @author		Huasituo <info@huasituo.com>
 * @license     http://www.huasituo.com/license
 * @copyright   Copyright (c) 2014 - 9999, huasituo.Com, Inc.
 */
class Kindeditor extends FieldAbs {
	
	/**
     * 构造函数 Ueditor **
     */
    public function __construct() {
		parent::__construct();
		$this->name = 'KindEditor';	// 字段名称
		$this->fieldtype = array('MEDIUMTEXT' => ''); // TRUE表全部可用字段类型,自定义格式为 array('可用字段类型名称' => '默认长度', ... )
		$this->defaulttype = 'MEDIUMTEXT'; // 当用户没有选择字段类型时的缺省值
    }
	
	/**
	 * 字段相关属性参数
	 *
	 * @param	array	$value	值
	 * @return  string
	 */
	public function option($option) 
	{
		$option['key'] = isset($option['key']) ? $option['key'] : '';
		$option['mode'] = isset($option['mode']) ? $option['mode'] : 1;
		$option['source'] = isset($option['source']) ? $option['source'] : 1;
		$option['pagebreak'] = isset($option['pagebreak']) ? $option['pagebreak'] : 0;
		$option['tool'] = isset($option['tool']) ? $option['tool'] : '\'fontname\', \'fontsize\', \'|\', \'forecolor\', \'hilitecolor\', \'bold\', \'italic\', \'underline\',\'removeformat\', \'|\', \'justifyleft\', \'justifycenter\', \'justifyright\', \'insertorderedlist\',\'insertunorderedlist\', \'|\', \'emoticons\', \'image\', \'link\'';
        $option['mode2'] = isset($option['mode2']) ? $option['mode2'] : $option['mode'];
		$option['tool2'] = isset($option['tool2']) ? $option['tool2'] : $option['tool'];
		$option['value'] = isset($option['value']) ? $option['value'] : '';
		$option['fvalue'] = isset($option['fvalue']) ? $option['fvalue'] : '';
		$option['width'] = isset($option['width']) ? $option['width'] : '90%';
		$option['height'] = isset($option['height']) ? $option['height'] : 400;
		$option['fieldtype'] = isset($option['fieldtype']) ? $option['fieldtype'] : '';
		$option['fieldlength'] = isset($option['fieldlength']) ? $option['fieldlength'] : '';
		
		return '
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::public.width').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][width]" value="'.$option['width'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_width" data-tips="'.hst_lang('hstcms::manage.fields.type.width.tips').'">'.hst_lang('hstcms::manage.fields.type.width.tips').'</div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::public.height').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="text" name="setting[option][height]" value="'.$option['height'].'" class="hstui-input hstui-length-5">
	            <div class="hstui-form-input-tips" id="J_form_tips_height" data-tips="'.hst_lang('hstcms::fields.type.height.tips').'">'.hst_lang('hstcms::fields.type.height.tips').'</div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::manage.editor.admin').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="radio" value="1" name="setting[option][mode]" '.($option['mode'] == 1 ? 'checked' : '').' onclick="$(\'#bjqms1\').hide()">&nbsp;<label>'.hst_lang('hstcms::manage.editor.type.001').'</label>&nbsp;&nbsp;
                    <input type="radio" value="2" name="setting[option][mode]" '.($option['mode'] == 2 ? 'checked' : '').' onclick="$(\'#bjqms1\').hide()">&nbsp;<label>'.hst_lang('hstcms::manage.editor.type.002').'</label>&nbsp;&nbsp;
                    <input type="radio" value="3" name="setting[option][mode]" '.($option['mode'] == 3 ? 'checked' : '').' onclick="$(\'#bjqms1\').show()">&nbsp;<label>'.hst_lang('hstcms::manage.editor.type.003').'</label>&nbsp;&nbsp;
	            <div class="hstui-form-input-tips" id="J_form_tips_mode" data-tips=""></div>
	          </div>
	        </div>
			<div id="bjqms1" '.($option['mode'] < 3 ? 'style="display:none"' : '').' class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::manage.editor.admin.tool').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <textarea name="setting[option][tool]" style="width:520px;height:150px;" class="hstui-input hstui-textarea">'.$option['tool'].'</textarea>
	            <div class="hstui-form-input-tips" id="J_form_tips_tool" data-tips="'.hst_lang('hstcms::manage.editor.admin.tool.tips').'">'.hst_lang('hstcms::manage.editor.admin.tool.tips').'</div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::manage.editor.index').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <input type="radio" value="1" name="setting[option][mode2]" '.($option['mode2'] == 1 ? 'checked' : '').' onclick="$(\'#bjqms2\').hide()">&nbsp;<label>'.hst_lang('hstcms::manage.editor.type.001').'</label>&nbsp;&nbsp;
                    <input type="radio" value="2" name="setting[option][mode2]" '.($option['mode2'] == 2 ? 'checked' : '').' onclick="$(\'#bjqms2\').hide()">&nbsp;<label>'.hst_lang('hstcms::manage.editor.type.002').'</label>&nbsp;&nbsp;
                    <input type="radio" value="3" name="setting[option][mode2]" '.($option['mode2'] == 3 ? 'checked' : '').' onclick="$(\'#bjqms2\').show()">&nbsp;<label>'.hst_lang('hstcms::manage.editor.type.003').'</label>&nbsp;&nbsp;
	            <div class="hstui-form-input-tips" id="J_form_tips_mode2" data-tips=""></div>
	          </div>
	        </div>
			<div id="bjqms2" '.($option['mode2'] < 3 ? 'style="display:none"' : '').' class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::manage.editor.index.tool').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
	              <textarea name="setting[option][tool2]" style="width:520px;height:150px;" class="hstui-input hstui-textarea">'.$option['tool2'].'</textarea>
	            <div class="hstui-form-input-tips" id="J_form_tips_tool2" data-tips="'.hst_lang('hstcms::manage.editor.index.tool.tips').'">'.hst_lang('hstcms::manage.editor.index.tool.tips').'</div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::manage.editor.ispage').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
                    <input type="radio" name="setting[option][pagebreak]" '.hst_ifCheck(!$option['pagebreak']).' value="0" />'.hst_lang('hstcms::public.no').'
                    <input type="radio" name="setting[option][pagebreak]" '.hst_ifCheck($option['pagebreak']).' value="1" />'.hst_lang('hstcms::public.yes').'
	            <div class="hstui-form-input-tips" id="J_form_tips_ispage" data-tips=""></div>
	          </div>
	        </div>
			<div class="hstui-form-group hstui-form-group-sm">
	          <label class="hstui-u-sm-2 hstui-form-label">'.hst_lang('hstcms::manage.editor.source').'</label>
	          <div class="hstui-u-sm-10 hstui-form-input">
                <div class="hstui-mr-sm"><input type="radio" name="setting[option][source]" '.hst_ifCheck(!$option['source']).' value="0" />'.hst_lang('hstcms::public.no').'
                    <input type="radio" name="setting[option][source]" '.hst_ifCheck($option['source']).' value="1" />'.hst_lang('hstcms::public.yes').'</div>
	            <div class="hstui-form-input-tips" id="J_form_tips_source" data-tips="'.hst_lang('hstcms::manage.editor.source.tips').'">'.hst_lang('hstcms::manage.editor.source.tips').'</div>
	          </div>
	        </div>
                '.$this->get_default_value($option['value']).$this->field_type($option['fieldtype'], $option['fieldlength'], $option['fvalue']);
	}
	
	/**
	 * 字段入库值
	 */
    public function insert_value($value, $field)
	{
		return $value;
	}
	
	/**
	 * 字段输出
	 *
	 * @param	array	$value	数据库值
	 * @return  string
	 */
	public function output($value, $cfg = []) 
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
		$source = isset($cfg['option']['source']) && $cfg['option']['source'] ? 'true' : 'false';
		$cfg['option']['value'] = isset($cfg['option']['value']) ? $cfg['option']['value'] : "";
		// 字段显示名称
		$text = (isset($cfg['validate']['required']) && $cfg['validate']['required'] == 1 ? '<font color="red">*</font>' : '').'&nbsp;'.$cname.'：';
		// 表单宽度设置
		$width = isset($cfg['option']['width']) && $cfg['option']['width'] ? $cfg['option']['width'] : '90%';
		// 表单高度设置
		$key = isset($cfg['option']['key']) && $cfg['option']['key'] ? $cfg['option']['key'] : '';
		$height = isset($cfg['option']['height']) && $cfg['option']['height'] ? $cfg['option']['height'] : '300';
		// 字段提示信息
		$tips = isset($cfg['validate']['tips']) && $cfg['validate']['tips'] ? $cfg['validate']['tips']: '';
		$_pagebreak = isset($cfg['option']['pagebreak']) ? $cfg['option']['pagebreak'] : 0;
		// 字段默认值
		$value = $value ? $value : $cfg['option']['value'];
		$style = 'style="width:'.$width.';height:'.$height.'px;"';
		// 输出
		$str = '';
		$tool = $this->isadmin ? "" : ''; // 后台引用时显示html工具栏
		$pagebreak = $name == 'content' || $_pagebreak ? ', \'pagebreak\'' : '';
		// 编辑器模式
		$mode = $this->isadmin ? $cfg['option']['mode'] : (isset($cfg['option']['mode2']) ? $cfg['option']['mode2'] : $cfg['option']['mode']);
		switch ($mode) {
			case 3: // 自定义
				$tool.= $this->isadmin ? $cfg['option']['tool'] : (isset($cfg['option']['tool2']) ? $cfg['option']['tool2'] : $cfg['option']['tool']);
				break;
			case 2: // 精简
				$tool.= "'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons'$pagebreak";
				break;
			case 1: // 默认
                $tool.= "'justifyleft', 'justifycenter', 'justifyright',
		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
		'superscript', 'clearhtml', 'quickformat','undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
		'plainpaste', 'wordpaste', '|',  'selectall', 'fullscreen','|', '/',
		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap',
		'anchor', 'link', 'unlink'$pagebreak";
				break;
		}
		
		// $uploadJson = site_index_url('upload/index', $urlA);
		$uploadJson ='';
		$str.= "
		<textarea class=\"hstui-input hstui-textarea\" name=\"$name\" id=\"hstcms_$name\" $style>$value</textarea>
		<script type=\"text/javascript\">
			Hstui.use('jquery', 'common', 'kindeditor', function() {
				Hstui.editer('#hstcms_$name', {
					source:$source,
					items:[$tool]
				});
			})
		</script>
		".$tips;
		return $this->input_format($name, $text, $str, $tips);
	}
}