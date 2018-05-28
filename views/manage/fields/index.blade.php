<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
<div class="table-main">

  <form class="hstui-form hstui-form-horizontal J_ajaxForm" action="{{ route('manageFieldsSave') }}" method="post">
    {!! hst_csrf() !!} 
    <input type="hidden" name="rname" value="{{ $rname }}">
    <input type="hidden" name="relatedid" value="{{ $relatedid }}">
    <table class="hstui-table hstui-table-bordered hstui-table-radius hstui-table-striped hstui-table-hover hstui-table-compact hstui-text-nowrap">
       <thead class="hstui-table-head">
            <tr>
                <th width="60" >{{ hst_lang('hstcms::public.vieworder') }}</th>
                <th width="20%" >{{ hst_lang('hstcms::public.name') }}</th>
                <th >{{ hst_lang('hstcms::manage.fields.name') }}</th>
                <th >{{ hst_lang('hstcms::public.type') }}</th>
                <th >{{ hst_lang('hstcms::public.main.table') }}</th>
                <th >{{ hst_lang('hstcms::manage.fields.ismember') }}</th>
                <th >{{ hst_lang('hstcms::public.status') }}</th>
                <th width="10%" >{{ hst_lang('hstcms::public.operation') }}</th>
            </tr>
        </thead>
        <tbody>
            @if($list)
            @foreach($list as $v)
            <tr>
                <td><input type="text" name="vieworder[{{$v['id']}}]" value="{!! $v['vieworder'] !!}" class="hstui-length-1 hstui-input"></td>
                <td>{!! $v['name'] !!}</td>
                <td>{!! $v['fieldname'] !!}</td>
                <td>{!! $v['fieldtype'] !!}</td>
                <td>@if($v['ismain']) {{ hst_lang('hstcms::public.yes') }} @else - @endif</td>
                <td>@if($v['ismember']) {{ hst_lang('hstcms::public.opens') }} @else - @endif</td>
                <td>@if(!$v['disabled']) {{ hst_lang('hstcms::public.opens') }} @else {{ hst_lang('hstcms::public.closes') }} @endif</td>
                <td>
                   <a href="{{ route('manageFieldsDelete', ['id'=>$v['id']]) }}" data-message="" class="J_ajax_delete" style="margin-right: 5px;">{{ hst_lang('hstcms::public.delete') }}</a>
                   <a  href="{{ route('manageFieldsEdit', ['id'=>$v['id'], 'rname'=>$rname, 'relatedid'=>$relatedid]) }}">{{ hst_lang('hstcms::public.edit') }}</a>
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
    @if($list)
    <div class="hstui-form-group">
      <div class="hstui-u-sm-12">
        <button type="submit" class="hstui-button hstui-button-default J_ajax_submit_btn">{{ hst_lang('hstcms::public.submit') }}</button>
      </div>
    </div>
    @endif
    </form>
</div>
</div>
<script>
Hstui.use('jquery','common',function() {
});
</script>
</body>
</html>