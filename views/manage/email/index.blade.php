<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
  {!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageConfigEmailSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('host')) hstui-form-error @endif" id="J_form_error_host">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.host') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="host" id="hstcms_host" value="@if($errors->has('host')){!! old('host') !!}@else{!! $config['host'] !!}@endif" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_host"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('port')) hstui-form-error @endif" id="J_form_error_port">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.port') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="port" id="hstcms_port" value="@if($errors->has('port')){!! old('port') !!}@else{!! $config['port'] !!}@endif" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_port"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('from')) hstui-form-error @endif" id="J_form_error_from">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.from') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="from" id="hstcms_from" value="@if($errors->has('port')){!! old('from') !!}@else{!! $config['from'] !!}@endif" class="hstui-input hstui-length-5 J_email_match">
            <div class="hstui-form-input-tips" id="J_form_tips_from"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('fromName')) hstui-form-error @endif" id="J_form_error_fromName">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.from.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="fromName" id="hstcms_fromName" value="@if($errors->has('fromName')){!! old('fromName') !!}@else{!! $config['from.name'] !!}@endif" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_fromName"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('auth')) hstui-form-error @endif" id="J_form_error_auth">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.email.auth') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="auth" id="hstcms_auth" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.close')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.open')}}" data-hstui-switchx @if(old('auth')) {{ hst_ifCheck(old('auth')) }} @else {{ hst_ifCheck($config['auth']) }} @endif data-switchx-text="auth"/>
            <div class="hstui-form-input-tips" id="J_form_tips_auth" data-tips="{{ hst_lang('hstcms::manage.email.auth.tips') }}">{{ hst_lang('hstcms::manage.email.auth.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('user')) hstui-form-error @endif" id="J_form_error_user">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.username') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="user" id="hstcms_user" value="@if($errors->has('user')){!! old('user') !!}@else{!! $config['user'] !!}@endif" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_user"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('password')) hstui-form-error @endif" id="J_form_error_password">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.password') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="password" id="hstcms_password" value="@if($errors->has('password')){!! old('password') !!}@else{!! $config['password'] !!}@endif" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_password"></div>
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