<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
  {!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageFieldsEditSave') }}" method="post">
    {!! hst_csrf() !!}
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="rname" value="{{ $rname }}">
    <input type="hidden" name="relatedid" value="{{ $relatedid }}">
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-frame-title">{{ hst_lang('hstcms::public.basic.information')}}</div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name"  value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::manage.fields.name.tips') }}">{{ hst_lang('hstcms::manage.fields.name.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('fieldname')) hstui-form-error @endif" id="J_form_error_fieldname">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="fieldname" id="hstcms_fieldname" value="{{ hst_value('fieldname', $info) }}" readonly class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_fieldname" data-tips="{{ hst_lang('hstcms::manage.fields.namex.tips') }}">{{ hst_lang('hstcms::manage.fields.namex.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('vieworder')) hstui-form-error @endif" id="J_form_error_vieworder">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.vieworder') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="vieworder" id="hstcms_vieworder" value="{{ hst_value('vieworder', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_vieworder" data-tips="{{ hst_lang('hstcms::manage.fields.vieworder.tips') }}">{{ hst_lang('hstcms::manage.fields.vieworder.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('issearch')) hstui-form-error @endif" id="J_form_error_issearch">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.issearch') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="issearch" id="hstcms_issearch" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.no')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.yes')}}" data-hstui-switchx @if(old('issearch')) {{ hst_ifCheck(old('issearch')) }}@else{{ hst_ifCheck($info['issearch'])}}@endif data-switchx-text="issearch"/>
            <div class="hstui-form-input-tips" id="J_form_tips_disabled" data-tips="{{ hst_lang('hstcms::manage.fields.issearch.tips') }}">{{ hst_lang('hstcms::manage.fields.issearch.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('disabled')) hstui-form-error @endif" id="J_form_error_disabled">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.status') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="disabled" id="hstcms_disabled" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.closes')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.opens')}}" data-hstui-switchx @if(old('disabled')) {{ hst_ifCheck(old('disabled')) }} @else {{ hst_ifCheck(!hst_value('disabled', $info)) }} @endif data-switchx-text="disabled"/>
            <div class="hstui-form-input-tips" id="J_form_tips_disabled" data-tips="{{ hst_lang('hstcms::manage.fields.status.tips') }}">{{ hst_lang('hstcms::manage.fields.status.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('fieldtype')) hstui-form-error @endif" id="J_form_error_fieldtype">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.type') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <select class="hstui-input hstui-select" disabled readonly name="fieldtype" id="hstcms_fieldtype">
                <option value="">{{ hst_lang('hstcms::public.please.select') }}</option>
                @foreach($fieldTypes as $fieldType)
                <option value="{{ $fieldType['id'] }}" {{ hst_isSelected($info['fieldtype'] == $fieldType['id']) }}>{{ $fieldType['name'] }}</option>
                @endforeach
              </select>
              <span id="hst_loading" style="display:none; font-size: 12px;margin-left: 10px; margin-top: 15px;">{{ hst_lang('hstcms::public.loading')}}</span>
            <div class="hstui-form-input-tips" id="J_form_tips_fieldtype" data-tips="{{ hst_lang('hstcms::manage.fields.type.tips') }}">{{ hst_lang('hstcms::manage.fields.type.tips') }}</div>
          </div>
        </div>
      </div>
      <div class="hstui-frame-content" id="hst_option"></div>
      <div class="hstui-frame-content">
        <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.fields.validators') }}</div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('isrequired')) hstui-form-error @endif" id="J_form_error_isrequired">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.isrequired') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <label><input type="radio" value="0" onClick="set_required(0)" name="setting[validate][required]" {{ hst_ifCheck(!hst_value('required', $info['setting']['validate'])) }}><span>{{ hst_lang('hstcms::public.no') }}</span></label>
              <label><input type="radio" value="1" onClick="set_required(1)" name="setting[validate][required]" {{ hst_ifCheck(hst_value('required', $info['setting']['validate'])) }}><span>{{ hst_lang('hstcms::public.yes') }}</span></label>
            <div class="hstui-form-input-tips" id="J_form_tips_isrequired" data-tips="{{ hst_lang('hstcms::manage.fields.isrequired.tips') }}">{{ hst_lang('hstcms::manage.fields.isrequired.tips') }}</div>
          </div>
        </div>
        <div id="required" class="hstui-form-group hstui-form-group-sm" @if(!$info['setting']['validate']['required'])style="display: none;" @endif >
          <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_pattern">
            <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.validator.pattern') }}</label>
            <div class="hstui-u-sm-10 hstui-form-input">
                <input type="text" name="setting[validate][pattern]" id="hstcms_pattern" value="{{ hst_value('pattern', $info['setting']['validate']) }}" class="hstui-input hstui-length-3">
                <select class="hstui-select " style="height: 37px; margin-left: 5px;" onChange="set_pattern(this)" name="pattern_select">
                  <option value="">{{ hst_lang('hstcms::public.regular.verification') }}</option>
                  <option value="/^[0-9.-]+$/">{{ hst_lang('hstcms::public.number') }}</option>
                  <option value="/^[0-9-]+$/">{{ hst_lang('hstcms::public.integer') }}</option>
                  <option value="/^[a-z]+$/i">{{ hst_lang('hstcms::public.letters') }}</option>
                  <option value="/^[0-9a-z]+$/i">{{ hst_lang('hstcms::public.number') }}+{{ hst_lang('hstcms::public.letters') }}</option>
                  <option value="/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/">E-mail</option>
                  <option value="/^[0-9]{5,20}$/">QQ</option>
                  <option value="/^http:\/\//">URL</option>
                  <option value="/^(1)[0-9]{10}$/">{{ hst_lang('hstcms::public.mobile') }}</option>
                  <option value="/^[0-9-]{6,13}$/">{{ hst_lang('hstcms::public.phone') }}</option>
                  <option value="/^[0-9]{6}$/">{{ hst_lang('hstcms::public.postal.code') }}</option>
                  </select>
              <div class="hstui-form-input-tips" id="J_form_tips_pattern" data-tips=""></div>
            </div>
          </div>
          <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_errortips">
            <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.validator') }}</label>
            <div class="hstui-u-sm-10 hstui-form-input">
                <input type="text" name="setting[validate][errortips]" id="hstcms_errortips" value="{{ hst_value('errortips', $info['setting']['validate']) }}" class="hstui-input hstui-length-5">
              <div class="hstui-form-input-tips" id="J_form_tips_errortips" data-tips="{{ hst_lang('hstcms::manage.fields.validator.tips') }}">{{ hst_lang('hstcms::manage.fields.validator.tips') }}</div>
            </div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_v_tips">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.tips') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="setting[validate][tips]" id="hstcms_v_tips" value="{{ hst_value('tips', $info['setting']['validate']) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_v_tips" data-tips="{{ hst_lang('hstcms::manage.fields.tips.tips') }}">{{ hst_lang('hstcms::manage.fields.tips.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('isedit')) hstui-form-error @endif" id="J_form_error_isedit">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.isedit') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="isedit" id="hstcms_isedit" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.no')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.yes')}}" data-hstui-switchx @if(old('isedit')){{ hst_ifCheck(old('isedit')) }}@else {{ hst_ifCheck(hst_value('isedit', $info['setting']['validate'])) }} @endif data-switchx-text="isedit"/>
            <div class="hstui-form-input-tips" id="J_form_tips_isedit" data-tips="{{ hst_lang('hstcms::manage.fields.isedit.tips') }}">{{ hst_lang('hstcms::manage.fields.isedit.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('isfrontshow')) hstui-form-error @endif" id="J_form_error_isfrontshow">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.front.end') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="isfrontshow" id="hstcms_isfrontshow" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.no')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.yes')}}" data-hstui-switchx @if(old('isfrontshow')) {{ hst_ifCheck(old('isfrontshow')) }} @else {{ hst_ifCheck(hst_value('isfrontshow', $info['setting']['option'])) }}@endif data-switchx-text="isfrontshow"/>
            <div class="hstui-form-input-tips" id="J_form_tips_isfrontshow" data-tips="{{ hst_lang('hstcms::manage.fields.front.end.tips') }}">{{ hst_lang('hstcms::manage.fields.front.end.tips') }}</div>
          </div>
        </div>
      </div>
      <div class="hstui-frame-content">
        <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.fields.show') }}</div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('ismshow')) hstui-form-error @endif" id="J_form_error_ismshow">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.fields.manage.content.list.show') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="ismshow" id="hstcms_ismshow" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.no')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.yes')}}" data-hstui-switchx @if(old('ismshow')) {{ hst_ifCheck(old('ismshow')) }} @else {{ hst_ifCheck(hst_value('ismshow', $info)) }}  @endif data-switchx-text="ismshow"/>
            <div class="hstui-form-input-tips" id="J_form_tips_ismshow" data-tips="{{ hst_lang('hstcms::manage.fields.manage.content.list.show.tips') }}">{{ hst_lang('hstcms::manage.fields.manage.content.list.show.tips') }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="hstui-form-button">
       <button type="submit" class="hstui-button hstui-button-primary J_ajax_submit_btn">{{ hst_lang('hstcms::public.save') }}</button>
    </div>    
  </form>
</div>
<script>
Hstui.use('jquery','common',function() {
  show_field_option('{{$info['fieldtype']}}');
});
function set_required(id) {
  if (id == 0) {
    $('#required').hide();
  } else {
    $('#required').show();
  }
}
function show_field_option(type) {
  $("#hst_loading").show();
  $.get('{!! route('publicFieldsTypeHtml', ['id'=>$info['id'], 'relatedid'=>$relatedid, 'rname'=>$rname]) !!}&rand='+Math.random(),{ type:type}, function(data){
    $('#hst_option').html(data);
    $("#hst_loading").hide();
  });
}
function hst_topinyin(t, f) {
  $.get('{!! route('publicTopinyin') !!}?rand='+Math.random(),{ str:$("#hstcms_"+f).val()}, function(data){
    $('#hstcms_'+t).val(data);
  });
}
function set_pattern(o)
{
  $('#hstcms_pattern').val(o.value)
}
</script>
</body>
</html>