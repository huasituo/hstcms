<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageBlockAddSave', ['module'=>$module]) }}" method="post">
    {!! hst_csrf() !!}
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name') }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('type')) hstui-form-error @endif" id="J_form_error_type">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.type') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
             <input type="radio" onchange="clickType('text')" name="type" value="text" checked> 
             <label>文本</label>
             <input type="radio" onchange="clickType('html')" name="type" value="html"> 
             <label>html</label>
             <input type="radio" onchange="clickType('image')" name="type" value="image"> 
             <label>图片</label>
            <div class="hstui-form-input-tips" id="J_form_tips_type" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('isopen')) hstui-form-error @endif" id="J_form_error_isopen">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.status') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="isopen" id="hstcms_isopen" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.closes')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.opens')}}" data-hstui-switchx @if(old('isopen')) {{ hst_ifCheck(old('isopen')) }}@else checked @endif data-switchx-text="isopen"/>
            <div class="hstui-form-input-tips" id="J_form_tips_isopen" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm hstui-hide @if($errors->has('image')) hstui-form-error @endif" id="J_form_error_image">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.image') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
            <div class="hstui-upload J_upload"></div>
            <div class="hstui-form-input-tips" id="J_form_tips_image" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm hstui-hide @if($errors->has('link')) hstui-form-error @endif" id="J_form_error_link">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.url') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="link" id="hstcms_link" value="{{ hst_value('link') }}" class="hstui-input hstui-length-6">
            <div class="hstui-form-input-tips" id="J_form_tips_link" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('content')) hstui-form-error @endif" id="J_form_error_content">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.content') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <textarea class="hstui-textarea" style="height: 420px; width: 100%;" name="content" id="hstcms_content"></textarea>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm hstui-hide @if($errors->has('contentv')) hstui-form-error @endif" id="J_form_error_contentv">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.content') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <textarea class="hstui-textarea" style="height: 420px; width: 100%;" name="contentv" id="hstcms_contentv"></textarea>
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
Hstui.use('jquery','common', 'upload', 'kindeditor', function() {
    Hstui.editer('#hstcms_contentv', {
      source:true
    });
    $(".J_upload").hstuiUpload({  
      fileName: 'filedata',
      fName: 'image',
      isedit: true,
      multi:false,
      url: '{{ route('uploadImageSave') }}',
      dataList: [],
      formParam: {
        upapp: 'block',
        _token: $("input[name='_token']").val()
      }
    });
});
function clickType(t) 
{
  if(t=='text') {
      $("#J_form_error_image").addClass('hstui-hide');
      $("#J_form_error_link").addClass('hstui-hide');
      $("#J_form_error_contentv").addClass('hstui-hide');
      $("#J_form_error_content").removeClass('hstui-hide');
  } else if(t=='html') {
      $("#J_form_error_image").addClass('hstui-hide');
      $("#J_form_error_link").addClass('hstui-hide');
      $("#J_form_error_content").addClass('hstui-hide');
      $("#J_form_error_contentv").removeClass('hstui-hide');
  } else if(t == 'image') {
      $("#J_form_error_content").addClass('hstui-hide');
      $("#J_form_error_contentv").addClass('hstui-hide');
      $("#J_form_error_image").removeClass('hstui-hide');
      $("#J_form_error_link").removeClass('hstui-hide');
  }
}
</script>
</body>
</html>