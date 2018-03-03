<!DOCTYPE html>
<html  class="no-js" lang="">
<head>
@include('hstcms::install.head')
</head>
<body>
@include('hstcms::install.header')
<section>
    <div class="content">
        <div class="form-group form-group-overfix">
            <div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
                <ul class="wizard-steps">
                    <li class="active" data-target="#step1">
                        <span class="step">1</span>
                        <span class="title">{{ hst_lang('hstcms::install.step1') }}</span>
                    </li>
                    <li class="active" data-target="#step2">
                        <span class="step">2</span>
                        <span class="title">{{ hst_lang('hstcms::install.step2') }}</span>
                    </li>
                    <li data-target="#step3">
                        <span class="step">3</span>
                        <span class="title">{{ hst_lang('hstcms::install.step3') }}</span>
                    </li>
                    <li data-target="#step4">
                        <span class="step">4</span>
                        <span class="title">{{ hst_lang('hstcms::install.step4') }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main" style="margin-bottom: 10px;">
            <div class="dialogs">
                {{ hst_lang('hstcms::install.environmental.testing') }}
                <table class="hstui-table hstui-table-bordered">
                    <tr>
                        <th>{{ hst_lang('hstcms::install.detection.project') }}</th>
                        <th>{{ $n }}{{ hst_lang('hstcms::install.required.configuration') }}</th>
                        <th>{{ $n }}{{ hst_lang('hstcms::install.optimum') }}</th>
                        <th>{{ hst_lang('hstcms::install.current.server') }}</th>
                    </tr>
                    <tr>
                        <td>{{ hst_lang('hstcms::install.operating.system') }}</td>
                        <td>{{ hst_lang('hstcms::install.unrestricted') }}</td>
                        <td>linux</td>
                        <td>{!! $env['OS'] !!}</td>
                    </tr>
                    <tr>
                        <td>{{ hst_lang('hstcms::install.php.v') }}</td>
                        <td>{!! $limitEnv['min']['php_version'] !!}</td>
                        <td>{!! $limitEnv['perfect']['php_version'] !!}</td>
                        <td>{!! $env['php_version'] !!}</td>
                    </tr>
                    <tr>
                        <td>{{ hst_lang('hstcms::install.attachments.upload') }}</td>
                        <td>{{ hst_lang('hstcms::install.unrestricted') }}</td>
                        <td>2M</td>
                        <td>{!! $env['file_upload'] !!}</td>
                    </tr>
                    <tr>
                        <td>GD</td>
                        <td>{!! $limitEnv['min']['gd'] !!}</td>
                        <td>{!! $limitEnv['perfect']['gd'] !!}</td>
                        <td>{!! $env['gd'] !!}</td>
                    </tr>
                    <tr>
                        <td>{{ hst_lang('hstcms::install.disk.space') }}</td>
                        <td>{!! $limitEnv['min']['disk_space'] !!}</td>
                        <td>{!! $limitEnv['perfect']['disk_space'] !!}</td>
                        <td>{!! $env['disk_space'] !!}</td>
                    </tr>
                </table>
                {{ hst_lang('hstcms::install.dir.file.jurisdiction') }}
                <table class="hstui-table hstui-table-bordered">
                    <tr><th>{{ hst_lang('hstcms::install.dir.file') }}</th><th>{{ hst_lang('hstcms::install.required.state') }}</th><th>{{ hst_lang('hstcms::install.current.state') }}</th></tr>
                    @foreach($fileRW as $item)
                    <tr>
                        <td>{!! $item['path'] !!}</td>
                        <td><span class="cor-blue2a text-size20">√</span> {{ hst_lang('hstcms::install.write1') }}</td>
                        <td>
                            @if($item['result'] == 1)<span class="cor-blue2a text-size20">√</span>@else<span class="cor-redfc text-size20">×</span>@endif
                            @if($item['result'] == 1){{ hst_lang('hstcms::install.write1') }}@elseif($item['result'] == -1){{ hst_lang('hstcms::install.noin') }}@else{{ hst_lang('hstcms::install.write2') }}@endif
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ hst_lang('hstcms::install.php.extension') }}
                <table class="hstui-table hstui-table-bordered">
                    <tr><th>{{ hst_lang('hstcms::install.required.extension') }}</th><th>{{ hst_lang('hstcms::install.required.state') }}</th><th>{{ hst_lang('hstcms::install.current.state') }}</th></tr>
                    @foreach($functionArr as $item)
                        <tr>
                            <td>{!! $item['extension'] !!}</td>
                            <td><span class="cor-blue2a text-size20">√</span> {{ hst_lang('hstcms::install.support1') }}</td>
                            <td>
                                @if($item['support'] == 'y')<span class="cor-blue2a text-size20">√</span>@else<span class="cor-redfc text-size20">×</span>@endif
                                @if($item['support'] == 'y'){{ hst_lang('hstcms::install.support1') }}@else{{ hst_lang('hstcms::install.support2') }}@endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer">
        <div class="btn-group shadow_con">
            <button onclick="window.location.href='{!! url('install?step=' . Crypt::encrypt(1)) !!}'" type="button" class="btn-white dropdown-toggle">
                {{ hst_lang('hstcms::install.go.back') }}
            </button>
        </div>
        @if(!$error)
        <a href="{!! url('install?step=' . Crypt::encrypt(3)) !!}" class="btn-orange shadow_con">{{ hst_lang('hstcms::install.start.install') }}</a>
        @endif
    </div>
</footer>
<script>
Hstcms.use('jquery', 'common', function(){
    
});
</script>
</body>
</html>