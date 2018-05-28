<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 600px; height:355px">
<form method="post" class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageMenuNavEditSave') }}">
    <input type="hidden" name="id" id="hstcms_id" value="{!! $id !!}">
    {{ hst_csrf() }}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('parent')) hstui-form-error @endif" id="J_form_error_parent">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.username') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
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
                <div class="hstui-form-input-tips" id="J_form_tips_parent" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::public.enter.one.name') }}">{{ hst_lang('hstcms::public.enter.one.name') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('ename')) hstui-form-error @endif" id="J_form_error_ename">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.ename') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="ename" id="hstcms_ename" value="{{ hst_value('ename', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_ename" data-tips="{{ hst_lang('hstcms::public.enter.one.ename') }}">{{ hst_lang('hstcms::public.enter.one.ename') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('url')) hstui-form-error @endif" id="J_form_error_url">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.url') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="url" id="hstcms_url" value="{{ hst_value('url', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_url" data-tips="{{ hst_lang('hstcms::public.enter.one.url') }}">{{ hst_lang('hstcms::public.enter.one.url') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('icon')) hstui-form-error @endif" id="J_form_error_icon">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.icon') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="icon" id="hstcms_icon" value="{{ hst_value('icon', $info) }}" class="hstui-input hstui-length-4">
            <div class="hstui-form-input-tips" id="J_form_tips_icon" data-tips="{{ hst_lang('hstcms::public.enter.one.icon') }}">{{ hst_lang('hstcms::public.enter.one.icon') }}</div>
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