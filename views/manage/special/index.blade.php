<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<div class="table-main">
    <table class="hstui-table hstui-table-bordered hstui-table-radius hstui-table-striped hstui-table-hover hstui-table-compact hstui-text-nowrap">
       <thead class="hstui-table-head">
            <tr>
                <th width="80" >{{ hst_lang('ID') }}</th>
                <th width="20%" >{{ hst_lang('hstcms::public.name') }}</th>
                <th >{{ hst_lang('hstcms::public.dir') }}</th>
                <th width="10%" >{{ hst_lang('hstcms::public.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($list)
            @foreach($list as $v)
            <tr>
                <td>{!! $v['id'] !!}</td>
                <td>{!! $v['name'] !!}</td>
                <td>{!! $v['dir'] !!}</td>
                <td>
                   <a href="{{ route('manageSpecialDelete', ['id'=>$v['id'], 'module'=>$module]) }}" class="J_ajax_del" style="margin-right: 5px;">{{ hst_lang('hstcms::public.delete') }}</a>
                   <a class="J_dialog" title="{{ hst_lang('hstcms::public.edit') }}" href="{{ route('manageSpecialEdit', ['id'=>$v['id'], 'module'=>$module]) }}">{{ hst_lang('hstcms::public.edit') }}</a>
                   <a href="{{ route('specialViewDir', ['dir'=>$v['dir']]) }}" target="_block">{{ hst_lang('hstcms::public.view') }}</a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9">{!! hst_lang('hstcms::public.no.list') !!}</td>
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