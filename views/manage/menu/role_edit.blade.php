<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 400px; height:365px">
<form method="post" class="J_ajaxForm" action="{{ route('manageMenuRoleEditSave') }}">
<input type="hidden" name="id" value="{!! $id !!}" id="hstcms_id">
    {{ hst_csrf() }}
    <div class="hstui-pop-cont hstui-pop-table">
        <div class="hstui-form hstui-form-horizontal">
            <div class="hstui-form-group" id="J_form_error_name">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
                <input type="text" name="name" id="hstcms_name" class="hstui-form-field hstui-length-4" value="{{ hst_value('name', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.name') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_ename">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.ename') }}</label>
                <input type="text" name="ename" id="hstcms_ename" class="hstui-form-field hstui-length-4" value="{{ hst_value('ename', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.ename') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_uri">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.uri') }}</label>
                <input type="text" name="uri" id="hstcms_uri" class="hstui-form-field hstui-length-4" value="{{ hst_value('uri', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.uri') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_parent">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.ascription') }}</label>
                <input type="text" name="parent" id="hstcms_parent" class="hstui-form-field hstui-length-4" value="{{ hst_value('parent', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.ascription') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_remark">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.remark') }}</label>
                <input type="text" name="remark" id="hstcms_remark" class="hstui-form-field hstui-length-4" value="{{ hst_value('remark', $info) }}">
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