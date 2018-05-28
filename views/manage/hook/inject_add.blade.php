<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width:690px; height: 500px">
<form method="post" class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageHookInjectAddSave', ['name'=>$hook_name]) }}">
    {{ hst_csrf() }}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label"><font color="red">*</font>{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name') }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::public.enter.one.name') }}">{{ hst_lang('hstcms::public.enter.one.name') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('alias')) hstui-form-error @endif" id="J_form_error_alias">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::hook.alias') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="alias" id="hstcms_alias" value="{{ hst_value('alias') }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_alias" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('files')) hstui-form-error @endif" id="J_form_error_files">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::hook.files') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="files" id="hstcms_files" value="{{ hst_value('files') }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_files" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('class')) hstui-form-error @endif" id="J_form_error_class">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::hook.class') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="class" id="hstcms_class" value="{{ hst_value('class') }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_class" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('fun')) hstui-form-error @endif" id="J_form_error_fun">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::hook.fun') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="fun" id="hstcms_fun" value="{{ hst_value('fun') }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_fun" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('description')) hstui-form-error @endif" id="J_form_error_description">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::hook.description') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
                <textarea name="description" id="hstcms_description" class="hstui-input hstui-textarea hstui-length-4" placeholder="" style="height: 120px">{{ hst_value('description') }}</textarea>
            <div class="hstui-form-input-tips" id="J_form_tips_description" data-tips=""></div>
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