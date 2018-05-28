<?php

namespace Huasituo\Hstcms\Libraries;

use Huasituo\Hstcms\Model\AttachmentModel;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

/**
* 
*/
class HstcmsFields
{
	public $objects = [];
    public $isadmin = false;

	/**
	 * 获取字段类别对象 **
	 *
	 * @param   string $name    字段类别名称
	 * @param   string	$module	模块名称
	 * @return  object
	 */
    public function get($name)
    {
        if (!$name || strpos($name, '.') !== FALSE) {
            return NULL;
        }
		$class = ucfirst($name);
		$files = 'Huasituo\Hstcms\Libraries\Fields';
		$fieldClass = $this->field_class($files, $class);
		if(!class_exists($fieldClass)) {
            return NULL;
		}
		if (isset($this->objects[$class])) {
			return $this->objects[$class];
		} else {
			return $this->objects[$class] = new $fieldClass();
		}
	}

	/**
	 * 自定义字段选项信息 
	 *
	 * @param   string	$name	字段类别名称
	 * @param   array 	$option	选项值
	 * @return  string
	 */
	public function option($name, $option = NULL, $fields = [])
	{
		return $name ? $this->get($name)->option($option, $fields) : NULL;
	}
	
	
	/**
	 * 获取可用字段类别 **
	 *
	 * @return  array
	 */
	public function type()
	{
		$file = new Filesystem();
        $path    = realpath(__DIR__.'/../Libraries/Fields');
        $fields = $file->glob($path.'/*.php');
		$data = [];
        if($fields) {
        	foreach ($fields as $key => $value) {
				$name = substr(basename($value), 0, -4);
				if($name != 'FieldAbs') {
					$obj = $this->get($name);
					$data[] = array('id' => $name, 'name' => $obj->name);
				}
        	}
        }
		return $data;
	}
    
    /**
     * Return the full path to the given  class.
     *
     * @param  string  $class
     * @return string
     */
    protected function field_class($namespace, $class)
    {
        return "{$namespace}\\{$class}";
    }

    public function input_html($fields = [], $data = NULL, $cat = FALSE, $id = 0)
    {
        $group = [];
        $myfield = $mygroup = $mycat = $mark = '';
        if ($cat == TRUE) {
            $mycat = '<div id="hstcms_category_field"></div>';
        }
        if (!$fields) {
            return $mycat;
        }
        // 分组字段筛选
        foreach ($fields as $t) {
            if ($t['fieldtype'] == 'Group'
                && preg_match_all('/\{(.+)\}/U', $t['setting']['option']['value'], $value)) {
                foreach ($value[1] as $v) {
                    $group[$v] = $t['fieldname'];
                }
            }
        }
        foreach ($fields as $t) {
            if(!$this->isadmin && isset($t['setting']['option']['isfrontshow']) && !$t['setting']['option']['isfrontshow']) {
                continue;
            }
            $obj = $this->get($t['fieldtype']);
            if (is_object($obj)) {
                $obj->isadmin = $this->isadmin;
                // 百度地图特殊字段
                if($t['fieldtype'] == 'Baidumap') {
                    if(isset($data[$t['fieldname'] . '_lng'])) {
                        $value = $data[$t['fieldname'] . '_lng'] . ',' . $data[$t['fieldname'] . '_lat'];
                    } else {
                        $value = '' ;
                    }
                } else {
                    $value = isset($data[$t['fieldname']]) ? $data[$t['fieldname']] : '';
                }
                if (isset($group[$t['fieldname']])) {
                    $obj->format = '{value}';
                    $input = $obj->input($t['name'], $t['fieldname'], $t['setting'], $value, isset($data[$id]) ? $data[$id] : 0);
                    //$input = preg_replace('/(<tr id=.*<td>)/Usi', '', $input);
                    //$input = str_replace(array('</td>', '</tr>'), '', $input);
                    $mygroup[$t['fieldname']] = $input;
                } else {
                    $input = $obj->input($t['name'], $t['fieldname'], $t['setting'], $value, isset($data[$id]) ? $data[$id] : 0);
                    // 将栏目附加字段放在内容或者作者上面一行
                    if ($cat == TRUE && $mark == '' && in_array($t['fieldname'], ['content', 'hits'])) {
                        $mark = 1;
                        $myfield .= $mycat;
                    }
                    $myfield .= $input;
                }
            }
        }
        if ($cat == TRUE && $mark == '') {
            $myfield .= $mycat;
        }
        if ($mygroup) {
            foreach ($mygroup as $name => $t) {
                $myfield = str_replace('{' . $name . '}', $t, $myfield);
            }
        }
        return $myfield;
    }

    /**
     * 表单提交数据验证和过滤
     *
     * @param   array   $request  	Request
     * @param   array   $_field 字段
     * @param   array   $_data  修改前的数据
     * @return  array
     */
    public function validate_filter(Request $request, $_fields, $_data = [])
    {
    	$postData = [];
    	$error = [];
        foreach ($_fields as $field) {
            if(!$this->isadmin && isset($field['setting']['option']['isfrontshow']) && !$field['setting']['option']['isfrontshow']) {
                continue;
            }
            $obj = $this->get($field['fieldtype']);
            if (!$obj) {
                continue;
            }
            if ($field['fieldtype'] === 'Group') {
                continue;
            }
            $obj->isadmin = $this->isadmin;
            $fieldname = $field['fieldname'];
            $field['setting']['option']['fieldtype'] = isset($field['setting']['option']['fieldtype']) ? $field['setting']['option']['fieldtype'] : '';
            $validate = isset($field['setting']['validate']) ? $field['setting']['validate'] : ['required'=>0];
            $value = $request->get($fieldname);
            if (!$this->isadmin && $validate['isedit'] && isset($_data[$fieldname])) {
                $value = $_data[$fieldname];
            } else {
	            if($field['fieldtype'] == 'Date' || $field['fieldtype'] == 'DateTime') {
	            	$value = hst_str2time($value);
	            }
	            // 验证必填字段
	            if ($field['fieldtype'] != 'Group' && isset($validate['required']) && $validate['required']) {
	                if ($value == '') {
	                    if(isset($validate['kongzhitips']) && $validate['kongzhitips']) {
	            			$error[$fieldname] = [$validate['kongzhitips']];
	                    } else {
	            			$error[$fieldname] = [hst_buildContent('hstcms::fields.post.content.kongzhi', ['name'=>$field['name']])];
	                    }
	                } else {
		                // 正则验证
		                if (isset($validate['pattern']) && $validate['pattern'] && !preg_match($validate['pattern'], $value)) {
		                    if(isset($validate['errortips']) && $validate['errortips']) {
	                			$error[$fieldname] = [$validate['errortips']];
		                    } else {
	                			$error[$fieldname] = [hst_buildContent('hstcms::fields.post.content.error', ['name'=>$field['name']])];
		                    }
		                }
	                }
	            }
	            // 判断表字段值的唯一性
	            if ($field['ismain'] && isset($field['setting']['option']['unique']) && $field['setting']['option']['unique']) 
	            {
	            //     if ($this->db
	            //              ->where('id<>', (int)$_data['id'])
	            //              ->where($name, $this->post[$name])
	            //              ->count_all_results(MODULE_DIR)) {
	            //         return new HstError('yes.content', array('$s'=>$field['name']));
	            //     }
	            }
            }
            if (!$this->isadmin && $validate['isedit'] && isset($_data[$fieldname])) {
                $resultValue = $value; // 获取入库值
            } else {
                $resultValue = $obj->insert_value($value, $field); // 获取入库值
            }
            if ($field['fieldtype'] == 'Baidumap') {
                $postData[$field['relatedtable']][$fieldname.'_lng'] = (double)$resultValue[$fieldname.'_lng'];
                $postData[$field['relatedtable']][$fieldname.'_lat'] = (double)$resultValue[$fieldname.'_lat'];
            } else {
	            if (strpos($field['setting']['option']['fieldtype'], 'INT') !== FALSE) {
	                $postData[$field['relatedtable']][$fieldname] = (int)$resultValue;
	            } elseif ($field['setting']['option']['fieldtype'] == 'DECIMAL' || $field['setting']['option']['fieldtype'] == 'FLOAT') {
	                $postData[$field['relatedtable']][$fieldname] = (double)$resultValue;
	            } else {
	                $postData[$field['relatedtable']][$fieldname] = $resultValue ? $resultValue : '';
	            }
	        }
        }
        if($error) {
        	return ['status'=>'error', 'error'=>$error];
        }
        return ['status'=>'success', 'data'=>$postData];
    }

     /**
     * 字段输出格式化
     *
     * @param   array   $fields     可用字段集
     * @param   array   $data       数据
     * @return  string
     */
    public function field_format_value($fields, $data) 
    {
        if (!$fields || !$data || !is_array($data)) {
            return $data;
        }
        foreach ($data as $n => $value) {
            if (isset($fields[$n])) {
                $format = hst_get_value($fields[$n]['fieldtype'], $value, @$fields[$n]['setting']['option']);
                if ($format !== $value) {
                    $data['_' . $n] = $value;
                    $data[$n] = $format;
                }
            } elseif (strpos($n, '_lng') !== FALSE) { // 百度地图
                $name = str_replace('_lng', '', $n);
                if (isset($data[$name . '_lat'])) {
                    $data[$name] = '';
                    if ($data[$name . '_lng'] > 0 || $data[$name . '_lat'] > 0) {
                        $data[$name] = $data[$name . '_lng'] . ',' . $data[$name . '_lat'];
                    }
                }
            }
        }
        return $data;
    }

    public function saveAttach($appid, Request $request, $fields = []) 
    {
        foreach ($fields as $field) {
           if($field['fieldtype'] === 'File') {
                $v = $request->get($field['fieldname']);
                if($v) {
                    AttachmentModel::where('aid', $v['aid'])->update([
                        'app_id'=>$appid,
                        'descrip'=>(string)$v['descrip']
                    ]);
                }
           } else if($field['fieldtype'] === 'Files') {
                $v = $request->get($field['fieldname']);
                if($v) {
                    foreach ($v['aid'] as $k => $aid) {
                        AttachmentModel::where('aid', $aid)->update([
                            'app_id'=>$appid,
                            'descrip'=>(string)$v['descrip'][$k]
                        ]);
                    }
                }
                
           }
        }
        return true;
    }



}