<!doctype html>
<html>
<head>
@include('hstcms::manage.common.head')
</head>
<body>
<div class="manage-content">
{!! $navs !!}
    <div class="manage-search">
        <input class="hstui-input hstui-length-3" id="search-ename" placeholder="{!! hst_lang('hstcms::public.enter.one.ename') !!}" />
        <input class="hstui-input hstui-length-4" id="search-uri" placeholder="URI" />
        <input class="hstui-input hstui-length-4" id="search-parent" placeholder="{!! hst_lang('hstcms::public.enter.one.ascription') !!}" />        
        <a href="javascript:;" class="hstui-button hstui-button-default hstui-button-xs J_search">{{ hst_lang('hstcms::public.search') }}</a>
    </div>
    <div class="table-main">
        <table class="hstui-table hstui-table-radius hstui-table-striped hstui-table-compact hstui-text-nowrap" cellspacing="0" width="100%" id="dataTable">
           <thead class="hstui-table-head">
               <tr>
                    <th width="15%">{{ hst_lang('hstcms::public.name') }}</th>
                    <th width="15%">{{ hst_lang('hstcms::public.ename') }}</th>
                    <th width="15%">{{ hst_lang('hstcms::public.uri') }}</th>
                    <th width="15%">{{ hst_lang('hstcms::public.ascription') }}</th>
                    <th>{{ hst_lang('hstcms::public.remark') }}</th>
                    <th width="8%">{{ hst_lang('hstcms::public.operation') }}</th>
                </tr>
            </thead>
            <tbody id="list">
            </tbody>
        </table>
        <div class="table-footer"><div class="J_listPage hstui-fr"></div></div>
    </div>
</div>
<script type="text/html" id="listTpl">
    [: for(i=0; i < data.length; i++){ :]
          <tr>
            <td>[:=data[i]['name']:]</td>
            <td>[:=data[i]['ename']:]</td>
            <td>[:=data[i]['uri']:]</td>
            <td>[:=data[i]['parent']:]</td>
            <td>[:=data[i]['remark']:]</td>
            <td><a class="btn btn-xs btn-info J_dialog" title="{{ hst_lang('hstcms::public.add', 'hstcms::manage.role.uri') }}" href="{!! route('manageMenuRoleAdd') !!}?id=[:=data[i]['id']:]"><i class="hstui-icon hstui-icon-copy"></i></a>
                    <a class="btn btn-xs btn-info J_dialog" title="{{ hst_lang('hstcms::public.update','hstcms::public.data')}}" href="{!! route('manageMenuRoleEdit', ['id'=>'']) !!}/[:=data[i]['id']:]"><i class="hstui-icon hstui-icon-compose"></i></a>
                    <a class="btn btn-xs btn-danger J_ajax_del" href="{!! route('manageMenuRoleDelete', ['id'=>'']) !!}/[:=data[i]['id']:]"><i class="hstui-icon hstui-icon-trash"></i></a></td>
        </tr>
      [:}:]
</script>
<script>
Hstui.use('jquery','common',function() {
    var listdata = Hstui.listData({
        url: '{!! route('manageMenuRole') !!}',
        col:8,
        loadPage: true
    }, function(){
        Hstui.dataTable('#dataTable', {
            scrollY: Hstui.dataTableHW(),
            scrollX: true
        }, function() {
            Hstui.dataTableHW();
        });
    });
    $(".J_search").on('click',function(){
        listdata.data['ename'] = $('#search-ename').val();
        listdata.data['uri'] = $('#search-uri').val();
        listdata.data['parent'] = $('#search-parent').val();
        listdata.data['username'] = $('#search-username').val();
        listdata.loadPage = true;
        Hstui.listData(listdata);
    });
});
</script>
</body>
</html>