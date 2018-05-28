<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
  <div class="manage-search">
        <form action="{{ route('manageFormContent', ['formid'=>$formid]) }}" method="get">
        <input class="hstui-input hstui-length-1" id="search-uid" name="uid" value="{!! hst_value('uid', $args) !!}" placeholder="UID" />
        <input class="hstui-input hstui-length-3 J_datetime" name="stime" value="{!! hst_value('stime', $args) !!}" id="search-stime" placeholder="{!! hst_lang('hstcms::public.stime') !!}" />
        <input class="hstui-input hstui-length-3 J_datetime" name="etime" value="{!! hst_value('etime', $args) !!}" id="search-etime" placeholder="{!! hst_lang('hstcms::public.etime') !!}" />
        <button type="submit" class="hstui-button hstui-button-default hstui-button-xs J_search">{{ hst_lang('hstcms::public.search') }}</button>
        </form>
    </div>
<div class="table-main">
    <table class="hstui-table hstui-table-bordered hstui-table-radius hstui-table-striped hstui-table-hover hstui-table-compact hstui-text-nowrap">
       <thead class="hstui-table-head">
            <tr>
                <th width="50" >{{ hst_lang('ID') }}</th>
                <th width="60" >{{ hst_lang('UID') }}</th>
                <th width="160">{{ hst_lang('hstcms::public.times') }}</th>
                @foreach($showFields as $key=>$field)
                <th width="">{{ $field['name'] }}</th>
                @endforeach
                <th width="120" >{{ hst_lang('hstcms::public.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(count($list))
            @foreach($list as $v)
            <tr>
                <td>{!! $v['id'] !!}</td>
                <td>{!! (int)$v['created_uid'] !!}</td>
                <td>{!! hst_time2str($v['created_time'], 'Y-m-d H:i:s') !!}</td>
                @foreach($showFields as $key=>$field)
                <td>{{ @$v[$field['fieldname']] }}</td>
                @endforeach
                <td>
                    <a href="{{ route('manageFormContentDelete', ['formid'=>$formid, 'id'=>$v['id']]) }}" class="J_ajax_del"  style="margin-right: 5px;">{{ hst_lang('hstcms::public.delete') }}</a>
                    <a href="{{ route('manageFormContentEdit', ['formid'=>$formid, 'id'=>$v['id']]) }}" style="margin-right: 5px;">{{ hst_lang('hstcms::public.edit') }}</a>                    
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">{!! hst_lang('hstcms::public.no.list') !!}</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="table-footer"><div class="J_listPage hstui-fr">{!! $list->appends($args)->links() !!}</div></div>
</div>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>