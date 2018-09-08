<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageCaptchaSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('width')) hstui-form-error @endif" id="J_form_error_width">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.width') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="width" id="hstcms_width" value="{!! hst_value('width', $config) !!}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_width" data-tips="{!! hst_lang('hstcms::captcha.default.width') !!}">{!! hst_lang('hstcms::captcha.default.width') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('height')) hstui-form-error @endif" id="J_form_error_height">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.height') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="height" id="hstcms_height" value="{!! hst_value('height', $config) !!}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_height" data-tips="{!! hst_lang('hstcms::captcha.default.height') !!}">{!! hst_lang('hstcms::captcha.default.height') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('length')) hstui-form-error @endif" id="J_form_error_length">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.length') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="length" id="hstcms_length" value="{!! hst_value('length', $config) !!}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_length" data-tips="{!! hst_lang('hstcms::captcha.default.length') !!}">{!! hst_lang('hstcms::captcha.default.length') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_preview">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.preview') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <img src="{!! route('captchaIndexGet') !!}">
            <div class="hstui-form-input-tips" id="J_form_tips_preview"></div>
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
});
</script>
</body>
</html>