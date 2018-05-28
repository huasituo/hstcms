<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
  {!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageFormContentAddSave', ['formid'=>$id]) }}" method="post">
    {!! hst_csrf() !!}
    <input type="hidden" name="formid" value="{{ $id }}">
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        {!! $inputHtml !!}
      </div>
    </div>
    <div class="hstui-form-button">
        <button class="hstui-button " id="J_dialog_close">{{ hst_lang('hstcms::public.cancel')}}</button>
        <button type="submit" class="hstui-button hstui-button-primary J_ajax_submit_btn">{{ hst_lang('hstcms::public.submit')}}</button>
    </div>
  </form>
</div>
<script>
Hstui.use('jquery','common',function() {
});
function set_required(id) {
  if (id == 0) {
    $('#required').hide();
  } else {
    $('#required').show();
  }
}
function show_field_option(type) {
  $("#hst_loading").show();
  $.get('{!! route('publicFieldsTypeHtml', ['id'=>0]) !!}&rand='+Math.random(),{ type:type}, function(data){
    $('#hst_option').html(data);
    $("#hst_loading").hide();
  });
}
function hst_topinyin(t, f) {
  $.get('{!! route('publicTopinyin') !!}?rand='+Math.random(),{ str:$("#hstcms_"+f).val()}, function(data){
    $('#hstcms_'+t).val(data);
  });
}
</script>
</body>
</html>