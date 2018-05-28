<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
    {!! $navs !!}
    <div class="table-main">
        <table class="hstui-table hstui-table-radius hstui-table-striped hstui-text-nowrap" cellspacing="0" width="100%" id="dataTable">
           <thead class="hstui-table-head">
               <tr>
                  <th width="" >{!! hst_lang('hstcms::public.name') !!}</th>
                  <th width="12%" >{!! hst_lang('hstcms::public.ename') !!}</th>
                  <th width="10%" >{!! hst_lang('hstcms::public.version') !!}</th>
                  <th width="" >{!! hst_lang('hstcms::public.description') !!}</th>
                  <th width="10%" >{!! hst_lang('hstcms::public.status') !!}</th>
                  <th width="10%" >{!! hst_lang('hstcms::public.operation') !!}</th>
                </tr>
            </thead>
            <tbody id="list">
            @if(count($list))
            @foreach($list as $v)
               <tr>
                <td>{!! $v['name'] !!}</td>
                <td>{!! $v['slug'] !!}</td>
                <td>{!! $v['version'] !!}</td>
                <td>{!! $v['description'] !!}</td>
                <td>@if($v['enabled']) <a class="J_ajax_refresh" href="{{route('manageModulesEnableds', ['slug'=>$v['slug'], 'enableds'=>0] )}}">{{hst_lang('hstcms::public.closes')}}</a> @else <a class="J_ajax_refresh" href="{{route('manageModulesEnableds', ['slug'=>$v['slug'], 'enableds'=>1] )}}">{{hst_lang('hstcms::public.opens')}}</a> @endif</td>
                <td>
                <a href="{!! route('manageModulesDouninstall', ['slug'=>$v['slug']]) !!}" class="J_ajax_del" data-msg="{{ hst_lang('hstcms::manage.modules.uninstall.tips') }}">{!! hst_lang('hstcms::public.uninstall') !!}</a>
                </td>
              </tr>
            @endforeach
            @else
            <tr>
              <td colspan="6">{{ hst_lang('hstcms::public.no.list') }}</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>