<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 600px; height:365px">
<form method="post" class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageMenuRoleAddSave') }}">
    {{ hst_csrf() }}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::public.enter.one.name') }}">{{ hst_lang('hstcms::public.enter.one.name') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('ename')) hstui-form-error @endif" id="J_form_error_ename">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.ename') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="ename" id="hstcms_ename" value="{{ hst_value('ename', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_ename" data-tips="{{ hst_lang('hstcms::public.enter.one.ename') }}">{{ hst_lang('hstcms::public.enter.one.ename') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('uri')) hstui-form-error @endif" id="J_form_error_uri">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.uri') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="uri" id="hstcms_uri" value="{{ hst_value('uri', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_uri" data-tips="{{ hst_lang('hstcms::public.enter.one.uri') }}">{{ hst_lang('hstcms::public.enter.one.uri') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('parent')) hstui-form-error @endif" id="J_form_error_parent">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.ascription') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="parent" id="hstcms_parent" value="{{ hst_value('parent', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_parent" data-tips="{{ hst_lang('hstcms::public.enter.one.ascription') }}">{{ hst_lang('hstcms::public.enter.one.ascription') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('remark')) hstui-form-error @endif" id="J_form_error_remark">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.remark') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="remark" id="hstcms_remark" value="{{ hst_value('remark', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_remark" data-tips=""></div>
          </div>
        </div>

      </div>
   </div>
    <div class="hstui-form-button">
        <button class="hstui-button " id="J_dialog_close">{{ hst_lang('hstcms::public.cancel')}}</button>
        <button type="submit" class="hstui-button hstui-button-primary J_ajax_submit_btn">{{ hst_lang('hstcms::public.submit')}}</button>
    </div>
</form>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>