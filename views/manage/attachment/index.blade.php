<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
<style>
.J_ul_list_public{
  width: 100%;
  overflow: hidden;
} 
.J_ul_list_public li{
  width: 100%;
  height: 40px;
  line-height: 40px;
}
.J_ul_list_public li input{
  margin-right: 10px
}
</style>
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageAttachSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm " id="J_form_error_name">
          <div class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.attach.storage') }}</div>
          <div class="hstui-u-sm-10 hstui-form-input">
              @foreach($storages as $key=>$val)
               <div class="hstui-u-sm-12">
                      <label class="blue mr10">
                        <input name="storage" value="{{ $key }}" type="radio"  {{ hst_ifCheck(hst_value('storage', $config) == $key) }} />
                        <span>{{ $val['name'] }} @if($val['manageurl'])<a href="{{ $val['manageurl'] }}" class=""  style="margin-left: 10px">[{{ hst_lang('hstcms::public.configure') }}]</a>@endif</span>
                      </label>
                  <div class="hstui-form-input-tips" data-tips="{!! $val['desc'] !!}">{!! $val['desc'] !!}</div>
                </div>
              @endforeach
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('dirs')) hstui-form-error @endif" id="J_form_error_codelength">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.storage.dirs') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input" style="margin-bottom: 10px;">
              <input type="text" name="dirs" id="hstcms_dirs" value="{!! hst_value('dirs', $config) !!}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" >{{ hst_lang('hstcms::manage.storage.dirs.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('dirs')) hstui-form-error @endif" id="J_form_error_codelength">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.storage.dirs') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input" style="margin-bottom: 10px;">
              <div>
                <ul id="J_ul_list_attachment" class="J_ul_list_public">
                <li>
                  <span class="span_3">{{ hst_lang('hstcms::manage.attachment.extsize.tips1') }}</span>
                  <span class="span_3">{{ hst_lang('hstcms::manage.attachment.extsize.tips2') }}</span>
                </li>
                @if(isset($config['extsize']))
                @foreach($config['extsize'] as $key=>$value)
                <li><input name="extsize[{!! $key !!}][ext]" type="text" class="hstui-input hstui-length-2" value="{!! $key !!}"><input name="extsize[{!! $key !!}][size]" type="text" class="hstui-input mr15 hstui-length-2"  value="{!! $value !!}"><a href="#" class="J_ul_list_remove">[{!! hst_lang('hstcms::public.delete') !!}]</a>
                </li>
                @endforeach
                @endif
              </ul>
              <a href="" class="link_add J_ul_list_add" data-related="attachment">{{ hst_lang('hstcms::manage.attachment.extsize.add') }}</a>
              </div>
            <div class="hstui-form-input-tips" data-tips="{{ hst_lang('hstcms::manage.attachment.extsize.tips') }}">{{ hst_lang('hstcms::manage.attachment.extsize.tips') }}<em style="color: red">{{ $maxSize }}</em></div>
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
var _li_html = '<li>\
          <input type="text" value="" class="hstui-input hstui-length-2" name="extsize[new_][ext]">\
            <input type="text" value="" class="hstui-input hstui-length-2 mr15" name="extsize[new_][size]"><a class="J_ul_list_remove" href="#">[{!! hst_lang('hstcms::public.delete') !!}]</a>\
        </li>';
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>