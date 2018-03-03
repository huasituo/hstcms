<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 400px; height:355px">
<form method="post" class="J_ajaxForm" action="{{ route('manageMenuNavEditSave') }}">
    <input type="hidden" name="id" id="hstcms_id" value="{!! $id !!}">
    {{ hst_csrf() }}
    <div class="hstui-pop-cont hstui-pop-table">
        <div class="hstui-form hstui-form-horizontal">
            <div class="hstui-form-group" id="J_form_error_parent">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.username') }}</label>
                <select class="hstui-length-4" name="parent" id="hstcms_parent">
                    <option value="0" {!! hst_isSelected('root' == $info['parent']) !!}>{!! hst_lang('hstcms::public.top.level') !!}</option>
                    @foreach($menus as $k=>$v)
                        <option value="{!! $v['id'] !!}" {!! hst_isSelected($v['ename'] == $info['parent']) !!}>{!! $v['name'] !!}</option>
                        @if(isset($v['items']) && $v['items'])
                        @foreach($v['items'] as $ks=>$vs)
                        <option value="{!! $vs['id'] !!}" {!! hst_isSelected($vs['ename'] == $info['parents'] && $vs['parent'] == $info['parent']) !!}>  --{!! $vs['name'] !!}</option>
                        @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="hstui-form-group" id="J_form_error_name">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
                <input type="text" name="name" id="hstcms_name" class="hstui-form-field hstui-length-4" value="{{ hst_value('name', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.name') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_ename">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.ename') }}</label>
                <input type="text" name="ename" id="hstcms_ename" class="hstui-form-field hstui-length-4" value="{{ hst_value('ename', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.ename') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_url">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">{{ hst_lang('hstcms::public.url') }}</label>
                <input type="text" name="url" id="hstcms_url" class="hstui-form-field hstui-length-4" value="{{ hst_value('url', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.url') }}">
            </div>
            <div class="hstui-form-group" id="J_form_error_icon">
                <label for="doc-ipt-pwd-21" class="hstui-u-sm-3 hstui-form-label">Icon</label>
                <input type="text" name="icon" id="hstcms_icon" class="hstui-form-field hstui-length-4" value="{{ hst_value('icon', $info) }}" placeholder="{{ hst_lang('hstcms::public.enter.one.icon') }}">
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