<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageSpecialEditSave', ['module'=>$module]) }}" method="post">
    {!! hst_csrf() !!}
    <input type="hidden" name="id" value="{{ $id }}" id="hstcms_id">
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input onBlur="hst_topinyin('dir', 'name');" type="text" name="name" id="hstcms_name" value="{{ hst_value('name', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_name" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('dir')) hstui-form-error @endif" id="J_form_error_dir">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.dir') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="dir" id="hstcms_dir" value="{{ hst_value('dir', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_dir" data-tips="{{ hst_lang('hstcms::manage.special.dir.tips') }}">{{ hst_lang('hstcms::manage.special.dir.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('domain')) hstui-form-error @endif" id="J_form_error_domain">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.special.domain') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
              <input type="text" name="domain" id="hstcms_domain" value="{{ hst_value('domain', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_domain" data-tips="{!! hst_lang('hstcms::manage.special.domain.tips') !!}">{!! hst_lang('hstcms::manage.special.domain.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('style')) hstui-form-error @endif" id="J_form_error_style">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.special.style') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
              <input type="text" name="style" id="hstcms_style" value="{{ hst_value('style', $info) }}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_style" data-tips="{!! hst_lang('hstcms::manage.special.style.tips') !!}">{!! hst_lang('hstcms::manage.special.style.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('isopen')) hstui-form-error @endif" id="J_form_error_isopen">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.status') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="isopen" id="hstcms_isopen" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.closes')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.opens')}}" data-hstui-switchx @if(old('isopen')) {{ hst_ifCheck(old('isopen')) }}@else {{ hst_ifCheck(hst_value('isopen', $info)) }} @endif data-switchx-text="isopen"/>
            <div class="hstui-form-input-tips" id="J_form_tips_isopen" data-tips=""></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('header')) hstui-form-error @endif" id="J_form_error_header">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.special.header') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="header" id="hstcms_header" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.closes')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.opens')}}" data-hstui-switchx @if(old('header')) {{ hst_ifCheck(old('header')) }}@else {{ hst_ifCheck(hst_value('header', $info)) }} @endif data-switchx-text="header"/>
            <div class="hstui-form-input-tips" id="J_form_tips_header" data-tips="{!! hst_lang('hstcms::manage.special.header.tips') !!}">{!! hst_lang('hstcms::manage.special.header.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('footer')) hstui-form-error @endif" id="J_form_error_footer">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.special.footer') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="footer" id="hstcms_footer" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.closes')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.opens')}}" data-hstui-switchx @if(old('footer')) {{ hst_ifCheck(old('footer')) }}@else {{ hst_ifCheck(hst_value('footer', $info)) }} @endif data-switchx-text="footer"/>
            <div class="hstui-form-input-tips" id="J_form_tips_footer" data-tips="{!! hst_lang('hstcms::manage.special.footer.tips') !!}">{!! hst_lang('hstcms::manage.special.footer.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('content')) hstui-form-error @endif" id="J_form_error_content">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.content') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <textarea class="hstui-textarea" style="height: 420px; width: 100%;" name="content" id="hstcms_content">{{ hst_value('content', $info) }}</textarea>
          </div>
        </div>
      </div>
      <div class="hstui-frame-title">SEO</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('title')) hstui-form-error @endif" id="J_form_error_title">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.seo.title') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
              <input type="text" name="title" id="hstcms_title" value="{{ hst_value('title', $info) }}" class="hstui-input hstui-length-6">
            <div class="hstui-form-input-tips" id="J_form_tips_title" data-tips="{!! hst_lang('hstcms::manage.seo.title.tips') !!}">{!! hst_lang('hstcms::manage.seo.title.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('keywords')) hstui-form-error @endif" id="J_form_error_keywords">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.seo.keywords') }}</label>
          <div class="hstui-u-sm-10  hstui-form-input">
              <input type="text" name="keywords" id="hstcms_keywords" value="{{ hst_value('keywords', $info) }}" class="hstui-input hstui-length-6">
            <div class="hstui-form-input-tips" id="J_form_tips_keywords" data-tips="{!! hst_lang('hstcms::manage.seo.keywords.tips') !!}">{!! hst_lang('hstcms::manage.seo.keywords.tips') !!}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('description')) hstui-form-error @endif" id="J_form_error_description">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.seo.description') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <textarea class="hstui-input hstui-textarea hstui-length-6" style="height: 120px;" name="description" id="hstcms_description">{{ hst_value('description', $info) }}</textarea>
              <div class="hstui-form-input-tips" id="J_form_tips_description" data-tips="{!! hst_lang('hstcms::manage.seo.description.tips') !!}">{!! hst_lang('hstcms::manage.seo.description.tips') !!}</div>
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
Hstui.use('jquery','common', 'kindeditor',function() {
    Hstui.editer('#hstcms_content', {
      source:true
    });
});
</script>
</body>
</html>