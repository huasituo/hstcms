<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageSmsSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.sms.platform') }}</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('request')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.selection.platform') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              @foreach($platforms as $key=>$val)
                <div class="hstui-u-sm-4">
                    <label class="blue mr10">
                      <input name="platform" value="{{ $key }}" type="radio"  {{ hst_ifCheck(hst_value('platform', $config) == $key) }} />
                      <span>{{ $val['name'] }} @if($val['surl'])<a href="{{ $val['surl'] }}" class="J_linkframe_trigger" data-id="sms{{ $key }}" data-name="{{ $val['name'] }}[{{ hst_lang('hstcms::public.configure') }}]" style="margin-left: 10px">[{{ hst_lang('hstcms::public.configure') }}]</a>@endif</span>
                    </label>
                </div>
                <div class="hstui-form-input-tips" id="J_form_tips_safeRequest">{!! $val['desc'] !!}</div>
              @endforeach
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