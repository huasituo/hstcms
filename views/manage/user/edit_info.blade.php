<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 400px; height: 490px">
<form method="post" class="J_ajaxForm" action="{{ route('manageUserInfoEditSave') }}">
    <input type="hidden" name="uid" value="{{ $uid }}">
    {{ hst_csrf() }}
    <div class="hstui-pop-cont hstui-pop-table">
        <div class="hstui-form hstui-form-horizontal">
            <div class="hstui-form-group" id="J_form_error_username">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.username') }}</label>
                <input type="text" class="hstui-form-field hstui-length-4" name="username" readonly value="{{ hst_value('username', $info) }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_password">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.password') }}</label>
                <input type="password" name="password" id="hstcms_password" class="hstui-form-field hstui-length-4" value="{{ hst_value('passowrd', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.password') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_name">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.realname') }}</label>
                <input type="text" name="name" id="hstcms_name" class="hstui-form-field hstui-length-4" value="{{ hst_value('name', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.password') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_mobile">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.mobile') }}</label>
                <input type="text" name="mobile" id="hstcms_mobile" class="hstui-form-field hstui-length-4" value="{{ hst_value('mobile', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.mobile') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_email">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">Email</label>
                <input type="text" name="email" id="hstcms_email" class="hstui-form-field hstui-length-4 J_email_match" value="{{ hst_value('email', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.email') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_qq">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">QQ</label>
                <input type="text" name="qq" id="hstcms_qq" class="hstui-form-field hstui-length-4" value="{{ hst_value('qq', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.qq') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_weixin">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.weixin') }}</label>
                <input type="text" name="weixin" id="hstcms_weixin" class="hstui-form-field hstui-length-4" value="{{ hst_value('weixin', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.weixin') }}">
            </div>
        </div>
    </div>
    <div class="hstui-pop-bottom">
        <button class="hstui-button " id="J_dialog_close">{{ hst_lang('hstcms::public.cancel')}}</button>
        <button type="submit" class="hstui-button hstui-button-primary J_ajax_submit_btn" data-dialog="1">{{ hst_lang('hstcms::public.submit')}}</button>
    </div>
</form>
<script>
Hstui.use('jquery','common',function() {
    Hstui.css('dialog');
});
</script>
</body>
</html>