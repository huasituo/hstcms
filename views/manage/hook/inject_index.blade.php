<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<div class="hstui-frame" style="width: 100%; margin-bottom: 10px">
    <div class="hstui-frame-title">{{ hst_lang('hstcms::public.e.info') }}</div>
    <div class="hstui-frame-content">
        <table class="hstui-table">
            <thead>
                <tr>
                    <td width="10%">{{ hst_lang('hstcms::hook.name')}}</td>
                <td>{!! $info['name'] !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::public.module') !!}</td>
                    <td>{!! $info['module'] !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::public.add', 'hstcms::public.times') !!}</td>
                    <td>{!! hst_time2str($info['times'], 'Y-m-d H:i:s') !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::public.description') !!}</td>
                    <td>{!! $info['description'] !!}</td>
                </tr>
                <tr>
                    <td>{!! hst_lang('hstcms::hook.document') !!}</td>
                    <td>{!! $info['document'] !!}</td>
                </tr>
            </thead>
        </table>

    </div>
</div>
<div class="table-main">
    <table class="hstui-table hstui-table-compact hstui-text-nowrap">
       <thead class="hstui-table-head">
            <tr>
                <th width="20%" >{{ hst_lang('hstcms::hook.alias') }}</th>
                <th >{{ hst_lang('hstcms::hook.description') }}</th>
                <th >{{ hst_lang('hstcms::hook.files') }}</th>
                <th >{{ hst_lang('hstcms::hook.class') }}</th>
                <th >{{ hst_lang('hstcms::hook.fun') }}</th>
                <th >{{ hst_lang('hstcms::public.times') }}</th>
                <th width="10%" >{{ hst_lang('hstcms::public.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($list)
            @foreach($list as $v)
            <tr>
                <td>{!! $v['alias'] !!}</td>
                <td>{!! $v['description'] !!}</td>
                <td>{!! $v['files'] !!}</td>
                <td>{!! $v['class'] !!}</td>
                <td>{!! $v['fun'] !!}</td>
                <td>{!! hst_time2str($v['times']) !!}</td>
                <td>
                    @if($v['issystem'] == 0)
                    <a class="btn btn-xs btn-info J_dialog" title="{{ hst_lang('hstcms::public.update')}}{{ hst_lang('hstcms::public.data')}}" href="{!! route('manageHookInjectEdit', ['name'=>$v['hook_name'], 'id'=>$v['id']]) !!}">{{ hst_lang('hstcms::public.update')}}</a>
                    <a class="btn btn-xs btn-info J_ajax_del" href="{!! route('manageHookInjectDelete', ['name'=>$v['hook_name'], 'id'=>$v['id']]) !!}">{{ hst_lang('hstcms::public.delete')}}</a>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7">{!! hst_lang('hstcms::public.no.list') !!}</td>
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