<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageSmsConfigSave') }}" method="post">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.sms.setting') }}</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('product')) hstui-form-error @endif" id="J_form_error_product">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.product') }}</label>
          <div class="hstui-u-sm-10" style="margin-bottom: 10px;">
            <div class="hstui-u-sm-4">
              <input type="text" name="product" id="hstcms_product" value="{!! hst_value('product', $config) !!}" class="hstui-input hstui-length-5">
            </div>
            <div class="hstui-form-input-tips" >{{ hst_lang('hstcms::manage.sms.product.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('codelength')) hstui-form-error @endif" id="J_form_error_codelength">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.code.length') }}</label>
          <div class="hstui-u-sm-10" style="margin-bottom: 10px;">
            <div class="hstui-u-sm-4">
              <input type="text" name="codelength" id="hstcms_codelength" value="{!! hst_value('codelength', $config) !!}" class="hstui-input hstui-length-5">
            </div>
            <div class="hstui-form-input-tips" >{{ hst_lang('hstcms::manage.sms.code.length.tips') }}</div>
          </div>
        </div>
        @foreach($types as $k=>$v)
        <div class="hstui-form-group hstui-form-group-sm " id="J_form_error_{{ $k }}">
          <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{{ $v['name'] }}</label>
          <div class="hstui-u-sm-10" style="margin-bottom: 10px;">
            <div class="hstui-u-sm-4">
              <input type="checkbox" name="{{ $k }}" id="hstcms_types_{{ $k }}" data-class="hstui-switchx-default hstui-round hstui-fl" data-switchx-offtext="{{ hst_lang('hstcms::public.close')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.open')}}" data-hstui-switchx {{ @hst_ifCheck($config['types'][$k]['status']) }} data-switchx-text="types_{{ $k }}"/>
            </div>
            <div class="hstui-form-input-tips" >{{ $v['desc'] }}</div>
          </div>
          <div class="hstui-u-sm-10">
            <div class="hstui-u-sm-4">
              <textarea class="hstui-textarea hstui-length-5" style="height: 80px;" name="types[{{ $k }}][content]" id="hstcms_content_{{ $k }}">{{ @$config['types'][$k]['content'] }}</textarea>
            </div>
            <div class="hstui-form-input-tips" >{!! $v['descs'] !!}</div>
          </div>
        </div>
        @endforeach
        <div class="hstui-form-group">
          <div class="hstui-u-sm-10 hstui-u-sm-offset-2">
            <button type="submit" class="hstui-button hstui-button-default J_ajax_submit_btn">{{ hst_lang('hstcms::public.save') }}</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>