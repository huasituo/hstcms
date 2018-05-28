<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageSafeSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.safe.setting') }}</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('request')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.request.log') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="request" id="hstcms_request" data-class="hstui-switchx-default hstui-round hstui-fl" data-switchx-offtext="{{ hst_lang('hstcms::public.close')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.open')}}" data-hstui-switchx @if(old('request')) {{ hst_ifCheck(old('request')) }} @else {{ hst_ifCheck($config['manage.request']) }} @endif data-switchx-text="safeRequest"/>
            <div class="hstui-form-input-tips" id="J_form_tips_safeRequest"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('operation')) hstui-form-error @endif" id="J_form_error_operation">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.operation.log') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="operation" id="hstcms_operation" data-class="hstui-switchx-default hstui-round hstui-fl" data-switchx-offtext="{{ hst_lang('hstcms::public.close')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.open')}}" data-hstui-switchx @if(old('operation')) {{ hst_ifCheck(old('operation')) }} @else {{ hst_ifCheck($config['manage.operation']) }} @endif data-switchx-text="operation"/>
            <div class="hstui-form-input-tips" id="J_form_tips_operation"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('loginCtime')) hstui-form-error @endif" id="J_form_error_operation">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.safe.login.ctime') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="loginCtime" id="hstcms_loginCtime" value="@if($errors->has('loginCtime')){!! old('loginCtime') !!}@else{!! $config['manage.login.ctime'] !!}@endif" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_loginCtime" data-tips="{{ hst_lang('hstcms::public.minute') }}，{{ hst_lang('hstcms::public.default') }}30{{ hst_lang('hstcms::public.minute') }}">{{ hst_lang('hstcms::public.minute') }}，{{ hst_lang('hstcms::public.default') }}30{{ hst_lang('hstcms::public.minute') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('safeIps')) hstui-form-error @endif" id="J_form_error_operation">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.safe.login.ips') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <textarea name="safeIps" id="hstcms_safeIps" value="@if($errors->has('safeIps')){!! old('safeIps') !!}@else{!! $config['manage.login.ips'] !!}@endif" class="hstui-input hstui-textarea hstui-length-4" style="height: 160px;"></textarea>
            <div class="hstui-form-input-tips" id="J_form_tips_safeIps" data-tips="{!! hst_lang('hstcms::manage.safe.login.ips.tips') !!}">{!! hst_lang('hstcms::manage.safe.login.ips.tips') !!}</div>
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