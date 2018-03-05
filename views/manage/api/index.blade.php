<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageApiSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.api.setting') }}</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('dirs')) hstui-form-error @endif" id="J_form_error_codelength">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.api.key') }}</label>
          <div class="hstui-u-sm-10" style="margin-bottom: 10px;">
            <div class="hstui-u-sm-4">
              <input type="text" name="key" id="hstcms_key" value="{!! hst_value('key', $config) !!}" class="hstui-input hstui-length-5">
            </div>
            <div class="hstui-form-input-tips" >{{ hst_lang('hstcms::manage.api.key.tips') }}</div>
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