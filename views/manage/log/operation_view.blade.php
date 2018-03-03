<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body style="width: 600px; height: 600px;">
<div class="hstui-scrollable-vertical" style="height: 600px;">
  <table class="hstui-table">
    <thead>
      <tr>
        <td>{{ hst_lang('hstcms::public.username')}}</td>
        <td>{!! $info['username'] !!}</td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.operation', 'hstcms::public.times') !!}</td>
        <td>{!! hst_time2str($info['times'], 'Y-m-d H:i:s') !!}</td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.operation') !!}IP</td>
        <td>{!! $info['ip'] !!}:{!! $info['port'] !!}</td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.operation','hstcms::public.operating.system') !!}</td>
        <td>{!! $info['platform'] !!}</td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.operation','hstcms::public.browser') !!}</td>
        <td>{!! $info['browser'] !!}</td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.remark') !!}</td>
        <td>{!! $info['remark'] !!}</td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.olddata') !!}</td>
        <td>
          <table class="hstui-table">
            <thead>
              @foreach($info['olddata'] as $key=>$val)
              <tr>
                <td>{!! $key !!}</td>
                <td>{!! $val !!}</td>
              </tr>
              @endforeach
            </thead>
          </table>
        </td>
      </tr>
      <tr>
        <td>{!! hst_lang('hstcms::public.newdata') !!}</td>
        <td>
          <table class="hstui-table">
            <thead>
              @foreach($info['newdata'] as $key=>$val)
              <tr @if(isset($info['olddata'][$key]) && $info['newdata'][$key] != $info['olddata'][$key]) style="color: red" @endif>
                <td>{!! $key !!}</td>
                <td>{!! $val !!}</td>
              </tr>
              @endforeach
            </thead>
          </table>
        </td>
      </tr>
    </thead>
  </table>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>