<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
  {!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageCachesMemcachedConfigSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('memdpsid')) hstui-form-error @endif" id="J_form_error_memdpsid">
          <label class="hstui-u-sm-2 hstui-form-label">persistent_id</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="memdpsid" id="hstcms_memdpsid" value="{{ hst_value('memdpsid', $config) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_memdpsid"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('memdhost')) hstui-form-error @endif" id="J_form_error_memdhost">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.host') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="memdhost" id="hstcms_memdhost" value="{{ hst_value('memdhost', $config) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_memdhost"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('memdport')) hstui-form-error @endif" id="J_form_error_memdport">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.port') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="memdport" id="hstcms_memdport" value="{{ hst_value('memdport', $config) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_memdport"></div>
          </div>
        </div>

        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('memdusername')) hstui-form-error @endif" id="J_form_error_memdusername">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.username') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="memdusername" id="hstcms_memdusername" value="{{ hst_value('memdusername', $config) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_memdusername"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('memdpassword')) hstui-form-error @endif" id="J_form_error_memdpassword">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.password') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="memdpassword" id="hstcms_memdpassword" value="{{ hst_value('memdpassword', $config) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_memdpassword"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="hstui-form-button">
       <button type="submit" class="hstui-button hstui-button-primary J_ajax_submit_btn">{{ hst_lang('hstcms::public.submit') }}</button>
    </div>
  </form>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>