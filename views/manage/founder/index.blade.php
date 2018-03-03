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
                <th width="20%" >{{ hst_lang('hstcms::public.username') }}</th>
                <th width="10%">{{ hst_lang('hstcms::public.realname') }}</th>
                <th width="10%">{{ hst_lang('hstcms::public.email') }}</th>
                <th width="10%">{{ hst_lang('hstcms::public.mobile') }}</th>
                <th width="10%">qq</th>
                <th width="10%">{{ hst_lang('hstcms::public.email') }}</th>
                <th>{{ hst_lang('hstcms::public.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($founders)
            @foreach($founders as $v)
            <tr>
                <td>{!! $v['username'] !!}</td>
                <td>{!! $v['name'] !!}</td>
                <td>{!! $v['email'] !!}</td>
                <td>{!! $v['mobile'] !!}</td>
                <td>{!! $v['qq'] !!}</td>
                <td>{!! $v['weixin'] !!}</td>
                <td width="40%">
                    <a class="btn btn-xs btn-info J_dialog" title="{{ hst_lang('hstcms::public.update')}}{!! $v['name'] !!}{{ hst_lang('hstcms::public.data')}}" href="{!! route('manageFounderEdit',['id'=>$v['uid']]) !!}"><i class="hstui-icon hstui-icon-compose"></i>{{ hst_lang('hstcms::public.update')}}</a>
                    <a class="btn btn-xs btn-danger J_ajax_del" href="{!! route('manageFounderDelete',['id'=>$v['uid']]) !!}"><i class="hstui-icon hstui-icon-trash"></i>{{ hst_lang('hstcms::public.delete')}}</a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7">{{ hst_lang('hstcms::public.no.list') }}</td>
            </tr>
            @endif
         </tbody>
    </table>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>