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
                    <li class="active" data-target="#step3">
                        <span class="step">3</span>
                        <span class="title">{{ hst_lang('hstcms::install.step3') }}</span>
                    </li>
                    <li class="active" data-target="#step4">
                        <span class="step">4</span>
                        <span class="title">{{ hst_lang('hstcms::install.step4') }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="conts conts-installing clearfix">
                <div class="pull-left conts-installing-icon">
                    <i class="fa  fa-check-circle"></i>
                </div>
                <div class="conts-installing-info">
                    <p class="conts-installing-tit">{{ hst_lang('hstcms::install.congratulations') }}，{!! $n !!}{!! $v !!}《{!! $name !!}》{{ hst_lang('hstcms::install.install.success') }}!</p>
                    <p class="conts-installing-titcont">{{ hst_lang('hstcms::install.install.success.tips') }}<br/>
                    <p class="conts-installing-titcont">
                        {{ hst_lang('hstcms::install.tb.tips') }}
                    </p>
                </div>
                <div class="footer">
                    <div class="shadow_con">
                        <a href="{!! url('/') !!}" class="btn-orange btn-ico">{{ hst_lang('hstcms::install.go.home') }}</a>
                    </div>
                    <div class="shadow_con">
                        <a href="{!! route('manageIndex') !!}" class="btn-orange btn-ico">{{ hst_lang('hstcms::install.go.manage') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>