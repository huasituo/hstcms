<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 800px; height: 500px;">
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageFormAddSave', ['module'=>$module, 'relatedid'=>$relatedid]) }}" method="post">
    {!! hst_csrf() !!}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.form.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input onBlur="hst_topinyin('table', 'name');" type="text" name="name" id="hstcms_name" value="{{ hst_value('name') }}" class="hstui-input hstui-length-3">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('table')) hstui-form-error @endif" id="J_form_error_table">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.form.table') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="table" id="hstcms_table" value="{{ hst_value('table') }}" class="hstui-input hstui-length-3">
            <div class="hstui-form-input-tips" id="J_form_tips_table" data-tips="{{ hst_lang('hstcms::manage.form.table.tips') }}">{{ hst_lang('hstcms::manage.form.table.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('mobile')) hstui-form-error @endif" id="J_form_error_mobile">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.form.mobile.notice') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
              <input type="text" name="mobile" id="hstcms_mobile" value="" class="hstui-input hstui-length-3">
            <div class="hstui-form-input-tips" id="J_form_tips_email" data-tips="{!! hst_lang('hstcms::manage.form.mobile.notice.tips') !!}">{!! hst_lang('hstcms::manage.form.mobile.notice.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('email')) hstui-form-error @endif" id="J_form_error_email">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.form.email.notice') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
              <input type="text" name="email" id="hstcms_email" value="" class="hstui-input hstui-length-3">
            <div class="hstui-form-input-tips" id="J_form_tips_email" data-tips="{!! hst_lang('hstcms::manage.form.email.notice.tips') !!}">{!! hst_lang('hstcms::manage.form.email.notice.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('emailcontent')) hstui-form-error @endif" id="J_form_error_emailcontent">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.form.email.content') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <textarea class="hstui-textarea hstui-length-4" style="height: 120px" name="emailcontent" id="hstcms_emailcontent"></textarea>
            <div class="hstui-form-input-tips" id="J_form_tips_emailcontent" data-tips="{!! hst_lang('hstcms::manage.form.email.content.tips') !!}">{!! hst_lang('hstcms::manage.form.email.content.tips') !!}</div>
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
function hst_topinyin(t, f) {
  $.get('{!! route('publicTopinyin') !!}?rand='+Math.random(),{ str:$("#hstcms_"+f).val()}, function(data){
    $('#hstcms_'+t).val(data);
  });
}
</script>
</body>
</html>