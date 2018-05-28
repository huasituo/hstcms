<!DOCTYPE html>
<html>
<head>
@include('hstcms::common.head')
</head>
<body>
<form  class="J_ajaxForm" method="post" action="{{ route('formContentSave') }}" enctype="multipart/form-data">
    {!! hst_csrf() !!} 
	<input type="hidden" name="formid" value="{{ $formid }}">
	{!! $inputHtml !!}
    <button type="submit" class="hstui-button hstui-button-default J_ajax_submit_btn">{{ hst_lang('hstcms::public.submit') }}</button>
</form>
<script>
Hstui.use('jquery','common',function() {

});	
</script>
</body>
</html>