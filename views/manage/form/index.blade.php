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
                <th width="20%" >{{ hst_lang('hstcms::manage.form.name') }}</th>
                <th >{{ hst_lang('hstcms::manage.form.table') }}</th>
                <th >{{ hst_lang('hstcms::manage.form.field') }}</th>
                <th >{{ hst_lang('hstcms::manage.form.email.notice') }}</th>
                <th >{{ hst_lang('hstcms::manage.form.mobile.notice') }}</th>
                <th >{{ hst_lang('hstcms::public.times') }}</th>
                <th >{{ hst_lang('hstcms::manage.form.content') }}</th>
                <th width="10%" >{{ hst_lang('hstcms::public.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($list)
            @foreach($list as $v)
            <tr>
                <td>{!! $v['id'] !!}</td>
                <td>{!! $v['name'] !!}</td>
                <td>{!! $v['table'] !!}</td>
                <td><a class="J_linkframe_trigger" data-id="form-fields-{{ $v['id'] }}" data-name="[{!! $v['name'] !!}]{{ hst_lang('hstcms::manage.form.field') }}" href="{{ route('manageFieldsIndex', ['rname'=>'form', 'relatedid'=>$v['id']]) }}">{{ hst_lang('hstcms::public.view') }}</a></td>
                <td>@if(isset($v['setting']['email']) && $v['setting']['email']){{ $v['setting']['email'] }}@else - @endif</td>
                <td>@if(isset($v['setting']['mobile']) && $v['setting']['mobile']){{ $v['setting']['mobile'] }}@else - @endif</td>
                <td>{!! $v['times_str'] !!}</td>
                <td> <a class="J_linkframe_trigger" data-id="form-content-{{ $v['id'] }}" data-name="[{!! $v['name'] !!}]{{ hst_lang('hstcms::manage.form.content') }}" href="{{ route('manageFormContent', ['formid'=>$v['id']]) }}">{{ hst_lang('hstcms::public.manage') }}</a> </td>
                <td>
                   <a href="{{ route('manageFormDelete', ['id'=>$v['id'], 'module'=>$module, 'relatedid'=>$relatedid]) }}" data-msg="{{ hst_lang('hstcms::manage.form.delete.msg') }}" class="J_ajax_del" style="margin-right: 5px;">{{ hst_lang('hstcms::public.delete') }}</a>
                   <a class="J_dialog" title="{{ hst_lang('hstcms::public.edit') }}" href="{{ route('manageFormEdit', ['id'=>$v['id'], 'module'=>$module, 'relatedid'=>$relatedid ]) }}">{{ hst_lang('hstcms::public.edit') }}</a>
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