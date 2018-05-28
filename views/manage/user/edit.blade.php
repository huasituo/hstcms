<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<form method="post" class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageUserEditSave') }}">
    <input type="hidden" name="uid" value="{{ $uid }}">
    {{ hst_csrf() }}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('gid')) hstui-form-error @endif" id="J_form_error_gid">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.role') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
                <select name="gid" id="hstcms_gid" class="hstui-length-2">
                    <option value="0">{{ hst_lang('hstcms::manage.select.role') }}</option>
                    @foreach($roles as $key=>$val)
                    <option value="{{ $val['id'] }}" {!! hst_isSelected($val['id'] == $info['gid']) !!}>{{ $val['name'] }}</option>
                    @endforeach
                </select>
            <div class="hstui-form-input-tips" id="J_form_tips_width" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('username')) hstui-form-error @endif" id="J_form_error_username">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.username') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="username" id="hstcms_username" value="{{ hst_value('username', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_username" data-tips="{{ hst_lang('hstcms::public.enter.one.username') }}">{{ hst_lang('hstcms::public.enter.one.username') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('password')) hstui-form-error @endif" id="J_form_error_password">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.password') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="password" id="hstcms_password" value="{{ hst_value('password') }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_password" data-tips="{{ hst_lang('hstcms::public.enter.one.password') }}">{{ hst_lang('hstcms::public.enter.one.password') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.realname') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::public.enter.one.realname') }}">{{ hst_lang('hstcms::public.enter.one.realname') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('mobile')) hstui-form-error @endif" id="J_form_error_mobile">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.mobile') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="mobile" id="hstcms_mobile" value="{{ hst_value('mobile', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_mobile" data-tips="{{ hst_lang('hstcms::public.enter.one.mobile') }}">{{ hst_lang('hstcms::public.enter.one.mobile') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('email')) hstui-form-error @endif" id="J_form_error_email">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.email') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="email" id="hstcms_email" value="{{ hst_value('email', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_mobile" data-tips="{{ hst_lang('hstcms::public.enter.one.email') }}">{{ hst_lang('hstcms::public.enter.one.email') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('qq')) hstui-form-error @endif" id="J_form_error_qq">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('QQ') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="qq" id="hstcms_qq" value="{{ hst_value('qq', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_qq" data-tips="{{ hst_lang('hstcms::public.enter.one.qq') }}">{{ hst_lang('hstcms::public.enter.one.qq') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('weixin')) hstui-form-error @endif" id="J_form_error_weixin">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.weixin') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="weixin" id="hstcms_weixin" value="{{ hst_value('weixin', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_weixin" data-tips="{{ hst_lang('hstcms::public.enter.one.weixin') }}">{{ hst_lang('hstcms::public.enter.one.weixin') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('status')) hstui-form-error @endif" id="J_form_error_status">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.status') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            <input type="checkbox" name="status" id="hstcms_status" data-class="hstui-switchx-default hstui-round hstui-mr-lg" data-switchx-offtext="{{ hst_lang('hstcms::public.disable')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.enable')}}" data-hstui-switchx {{ hst_ifCheck(!$info['status']) }} data-switchx-text="status"/>
            <div class="hstui-form-input-tips" id="J_form_tips_status" data-tips=""></div>
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