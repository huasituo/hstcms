<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="hstui-form hstui-form-horizontal">
    <div class="hstui-frame">
      <div class="hstui-frame-content">
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">disk</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_value('disk', $info) }}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">AID</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_value('aid', $info) }}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">UID</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            @if(hst_value('created_userid', $info)) {{ hst_value('created_userid', $info) }} @else - @endif
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">APP</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_value('app', $info) }}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">APPID</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            @if(hst_value('appid', $info)) {{ hst_value('appid', $info) }} @else - @endif
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.name') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_value('name', $info) }}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.type') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_value('type', $info) }}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.size') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {!! hst_byte_format($info['size']) !!}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm ">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.url') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_value('path', $info) }}
          </div>
        </div>
        <div class="hstui-form-group hstui-form-group-sm">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.times') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
            {{ hst_time2str($info['created_time'], 'Y-m-d H:i:s') }}
          </div>
        </div>
        @if(in_array($info['type'], ['jpeg', 'jpg', 'png', 'gif']))
        <div class="hstui-form-group hstui-form-group-sm">
          <label class="hstui-u-sm-2 hstui-form-label">{{ hst_lang('hstcms::public.pic') }}</label>
          <div class="hstui-u-sm-10 hstui-form-input">
           <a href="{{ $info['url'] }}" target="_b">
            <img src="{{ $info['url'] }}" style="width: 200px;">
          </a>
          </div>
        </div>
        @endif
      </div>
      <div class="hstui-form-button">
        
      </div>
    </div>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>