<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
    <table class="hstui-table hstui-table-bordered hstui-table-radius hstui-table-striped hstui-table-hover hstui-table-compact hstui-text-nowrap">
      <thead class="hstui-table-head">
        <tr>
          <th >{{ hst_lang('hstcms::manage.role.name') }}</th>
          <th width="20%">{{ hst_lang('hstcms::public.operation') }}</th>
        </tr>
      </thead>
      <tbody>
        @if($roles)
        @foreach($roles as $v)
        <tr>
          <td>{!! $v['name'] !!}</td>
          <td width="20%">
            <a class="btn btn-xs btn-info" title="{{ hst_lang('hstcms::public.update')}}" href="{!! route('manageRoleEdit',['id'=>$v['id']]) !!}"><i class="hstui-icon hstui-icon-compose"></i>{{ hst_lang('hstcms::public.update')}}</a>
            <a class="btn btn-xs btn-danger J_ajax_del" href="{!! route('manageRoleDelete',['id'=>$v['id']]) !!}"><i class="hstui-icon hstui-icon-trash"></i>{{ hst_lang('hstcms::public.delete')}}</a>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="2">{!! hst_lang('hstcms::public.no.list') !!}</td>
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