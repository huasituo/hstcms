<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 700px; height: 500px;">
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageAreaEditSave') }}" method="post">
    {!! hst_csrf() !!}
    <input type="hidden" name="areaid" value="{{$areaid}}">
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('areaid')) hstui-form-error @endif" id="J_form_error_areaid">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('Areaid') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" readonly name="areaid" id="hstcms_areaid" value="{{ hst_value('areaid', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_areaid" data-tips="{{ hst_lang('hstcms::manage.area.areaid') }}">{{ hst_lang('hstcms::manage.area.areaid') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('zip')) hstui-form-error @endif" id="J_form_error_zip">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.area.zip') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="zip" id="hstcms_zip" value="{{ hst_value('zip', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_zip" data-tips=""></div>
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
Hstui.use('jquery','common', 'kindeditor', function() {
    Hstui.editer('#hstcms_content', {
      source:true
    });
});
function hst_topinyin(t, f) {
  $.get('{!! route('publicTopinyin') !!}?rand='+Math.random(),{ str:$("#hstcms_"+f).val()}, function(data){
    $('#hstcms_'+t).val(data);
  });
}
</script>
</body>
</html>