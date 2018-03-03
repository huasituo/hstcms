<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageSmsHstsmsConfigSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-title">{{ hst_lang('hstcms::public.setting') }}</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_tiaos">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.tiaos') }}</label>
          <div class="hstui-u-sm-10">
            <div class="hstui-u-sm-4">
              
            </div>
            <div class="hstui-form-input-tips" id="J_form_tips_tiaos"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('hstsmsdaima')) hstui-form-error @endif" id="J_form_error_hstsmsdaima">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.daima') }}</label>
          <div class="hstui-u-sm-10">
            <div class="hstui-u-sm-4">
              <input type="text" name="hstsmsdaima" id="hstcms_hstsmsdaima" value="{!! hst_value('hstsmsdaima', $config) !!}" class="hstui-length-4">
            </div>
            <div class="hstui-form-input-tips" id="J_form_tips_hstsmsdaima"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('hstsmskey')) hstui-form-error @endif" id="J_form_error_hstsmskey">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.key') }}</label>
          <div class="hstui-u-sm-10">
            <div class="hstui-u-sm-4">
              <input type="text" name="hstsmskey" id="hstcms_hstsmskey" value="{!! hst_value('hstsmskey', $config) !!}" class="hstui-length-4">
            </div>
            <div class="hstui-form-input-tips" id="J_form_tips_hstsmskey"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('hstsmssign')) hstui-form-error @endif" id="J_form_error_hstsmssign">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.sign') }}</label>
          <div class="hstui-u-sm-10">
            <div class="hstui-u-sm-4">
              <input type="text" name="hstsmssign" id="hstcms_hstsmssign" value="{!! hst_value('hstsmssign', $config) !!}" class="hstui-length-4">
            </div>
            <div class="hstui-form-input-tips" id="J_form_tips_hstsmssign"></div>
          </div>
        </div>
        <div class="hstui-form-group">
          <div class="hstui-u-sm-10 hstui-u-sm-offset-2">
            <button type="submit" class="hstui-button hstui-button-default J_ajax_submit_btn">{{ hst_lang('hstcms::public.save') }}</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>