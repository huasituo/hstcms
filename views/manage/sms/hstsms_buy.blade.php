<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <form class="hstui-form hstui-form-horizontal" action="{{ route('manageSmsHstsmsBuys') }}" method="get" target="_b">
    {!! hst_csrf() !!} 
    <div class="hstui-frame">
      <div class="hstui-frame-title">{{ hst_lang('hstcms::manage.sms.purchase') }}</div>
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_tiaos">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.tiaos') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              @if($surplus['state'] == 0) <font color="red">{{ @$surplus['data']['surplus'] }}</font> 条 @else <font color="red">{{ $surplus['message'] }} </font>@endif
            <div class="hstui-form-input-tips" id="J_form_tips_tiaos"></div>
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm" id="J_form_error_money">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::manage.sms.pay.money') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
              <input type="text" name="money" id="hstcms_money" value="" class="hstui-input hstui-length-5">
            <div class="hstui-form-input-tips" id="J_form_tips_money"></div>
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