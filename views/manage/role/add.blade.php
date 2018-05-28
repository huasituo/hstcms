<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageRoleAddSave') }}" method="post">
  {!! hst_csrf() !!} 
  <div class="hstui-frame">
    <div class="hstui-frame-title">{!! hst_lang('hstcms::public.add', 'hstcms::public.role') !!}</div>
    <div class="hstui-frame-content">
      <div class="hstui-form-group hstui-form-group-sm @if($errors->has('name')) hstui-form-error @endif" id="J_form_error_name">
        <label class="hstui-u-sm-2 hstui-form-label">{!! hst_lang('hstcms::manage.role.name') !!}</label>
        <div class="hstui-u-sm-10 hstui-form-input">
          <input type="text" name="name" id="hstcms_name" value="{{ hst_value('name') }}" class="hstui-input hstui-length-3" placeholder="">
          <span class="hstui-form-input-tips" id="J_form_tips_name" data-tips="{{ hst_lang('hstcms::manage.enter.one.role.name') }}">{{ hst_lang('hstcms::manage.enter.one.role.name') }}</span>
        </div>
      </div>
      <div class="hstui-form-group hstui-form-group-sm">
        <div class="hstui-tab J_tab_wrap">
          <div class="hstui-tab-nav">
            <ul class="cc J_tabs_nav">
              @foreach($menus as $key=>$menu)
              <li>
                <a href="javascript:;">{!! $menu['name'] !!}</a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="J_tabs_content hstui-tab-content">
              @foreach($menus as $key=>$menu)
              <div class="p10 J_tabs_content_item">
                @if($menu['items'])
                 @foreach($menu['items'] as $k=>$v)  
                <div class="hstui-form-group hstui-form-group-sm">
                  <label class="hstui-u-sm-2 hstui-form-label">{!! $v['name'] !!}</label>
                  <div class="hstui-u-sm-10">
                    @if(isset($v['url']) && $v['url'])
                      @foreach($roleUriDatas[$k] as $r=>$rv)
                        <input name="auths[]" type="checkbox" value="{!! $rv['ename'] !!}"> {!! $rv['name'] !!}
                      @endforeach
                    @endif
                    @if(isset($v['items']) && $v['items'])
                    @foreach($v['items'] as $ks=>$vs) 
                    <div class="hstui-form-group hstui-form-group-sm">
                      <label for="doc-ipt-3-1" class="hstui-u-sm-2 hstui-form-label">{!! $vs['name'] !!}</label>
                      <div class="hstui-u-sm-10">
                          @if(isset($vs['url']) && $vs['url'])
                            @foreach($roleUriDatas[$ks] as $rs=>$rsv)
                              <label><input name="auths[]" type="checkbox" value="{!! $rsv['ename'] !!}"> {!! $rsv['name'] !!}</label>
                            @endforeach
                          @endif
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
                @endforeach
                @endif
              </div>
              @endforeach
          </div>
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