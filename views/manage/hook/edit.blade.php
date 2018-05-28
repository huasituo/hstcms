<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width:690px; height: 330px">
<form method="post" class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageHookEditSave') }}">
    <input type="hidden" name="name" id="hstcms_name" class="hstui-form-field hstui-length-4" value="{{ $name }}" placeholder="">
    {{ hst_csrf() }}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label"><font color="red">*</font>{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::public.enter.one.name') }}">{{ hst_lang('hstcms::public.enter.one.name') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('description')) hstui-form-error @endif" id="J_form_error_description">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.description') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="description" id="hstcms_description" value="{{ hst_value('description', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_description" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('document', $info)) hstui-form-error @endif" id="J_form_error_document">
          <label class="hstui-u-sm-2 hstui-form-label"><font color="red">*</font>{{ hst_lang('hstcms::hook.document') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
                <textarea name="document" id="hstcms_document" class="hstui-input hstui-textarea hstui-length-4" placeholder="" style="height: 120px">{{ hst_value('document') }}</textarea>
            <div class="hstui-form-input-tips" id="J_form_tips_document" data-tips=""></div>
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