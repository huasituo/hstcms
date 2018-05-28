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
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.product') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="product" id="hstcms_product" value="{!! hst_value('product', $config) !!}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" data-tips="{{ hst_lang('hstcms::manage.sms.product.tips') }}">{{ hst_lang('hstcms::manage.sms.product.tips') }}</div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm @if($errors->has('codelength')) hstui-form-error @endif" id="J_form_error_codelength">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.code.length') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="codelength" id="hstcms_codelength" value="{!! hst_value('codelength', $config) !!}" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" data-tips="{{ hst_lang('hstcms::manage.sms.code.length.tips') }}">{{ hst_lang('hstcms::manage.sms.code.length.tips') }}</div>
          </div>
        </div>
        @foreach($types as $k=>$v)
        <div class="hstui-form-group hstui-form-group-sm " id="J_form_error_{{ $k }}">
          <label class="hstui-u-sm-2 hstui-form-label">{{ $v['name'] }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="checkbox" name="{{ $k }}" id="hstcms_types_{{ $k }}" data-class="hstui-switchx-default hstui-round hstui-fl hstui-mr-sm" data-switchx-offtext="{{ hst_lang('hstcms::public.close')}}" data-switchx-ontext="{{ hst_lang('hstcms::public.open')}}" data-hstui-switchx {{ @hst_ifCheck($config['types'][$k]['status']) }} data-switchx-text="types_{{ $k }}"/>
            <div class="hstui-form-input-tips" >日发限制：{{$v['num'] }} {{ $v['desc'] }}</div>
          <div class="hstui-u-sm-12 hstui-form-input">
              <textarea class="hstui-input hstui-textarea hstui-length-5" style="height: 110px;" name="types[{{ $k }}][content]" id="hstcms_content_{{ $k }}">{{ @$config['types'][$k]['content'] }}</textarea>
            <div class="hstui-form-input-tips" data-tips="{!! $v['descs'] !!}">{!! $v['descs'] !!}</div>
          </div>
          </div>
        </div>
        @endforeach
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