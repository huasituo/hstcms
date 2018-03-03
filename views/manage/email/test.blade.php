<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageConfigEmailTestSubmit') }}" method="post">
  {!! hst_csrf() !!} 
  <div class="hstui-frame">
    <div class="hstui-frame-content">
      <div class="hstui-form-group hstui-form-group-sm " id="J_form_error_from">
        <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.from') }}</label>
        <div class="hstui-u-sm-10">
          <div class="hstui-u-sm-4">
            <input type="text" value="@if($errors->has('port')){!! old('from') !!}@else{!! $config['from'] !!}@endif" class="hstui-length-5 hstui-disabled" disabled>
          </div>
          <div class="hstui-form-input-tips" id="J_form_tips_from"></div>
        </div>
      </div>
      <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_fromName">
        <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.from.name') }}</label>
        <div class="hstui-u-sm-10">
          <div class="hstui-u-sm-4">
            <input type="text" value="@if($errors->has('fromName')){!! old('fromName') !!}@else{!! $config['from.name'] !!}@endif" class="hstui-length-5" disabled>
          </div>
          <div class="hstui-form-input-tips" id="J_form_tips_fromName"></div>
        </div>
      </div>
      <div class="hstui-form-group hstui-form-group-sm @if($errors->has('toemail')) hstui-form-error @endif" id="J_form_error_toemail">
        <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.toemail') }}</label>
        <div class="hstui-u-sm-10">
          <div class="hstui-u-sm-4">
            <input type="text" name="toemail" id="hstcms_toemail" value="@if($errors->has('toemail')){!! old('toemail') !!}@endif" class="hstui-length-5 J_email_match">
          </div>
            <div class="hstui-form-input-tips" id="J_form_tips_toemail"></div>
        </div>
      </div>
      <div class="hstui-form-group hstui-form-group-sm">
        <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{!! hst_lang('hstcms::manage.email.content') !!}</label>
        <div class="hstui-u-sm-10">
          <div class="hstui-u-sm-6">
              <div class="hstui-alert hstui-alert-secondary" style="overflow:hidden">
                {!! hst_lang('hstcms::manage.email.test.content.tips') !!}
              </div>
          </div>
        </div>
      </div>
      <div class="hstui-form-group">
        <div class="hstui-u-sm-10 hstui-u-sm-offset-2">
          <button type="submit" class="hstui-button hstui-button-default J_ajax_submit_btn">{{ hst_lang('hstcms::public.send') }}</button>
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