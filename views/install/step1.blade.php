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
                    <li data-target="#step2">
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
        <div class="main">
            <div class="dialogs">
                {!! hst_lang('hstcms::install.install.xy') !!}
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="footer">
        <a href="{!! url('install/?step=' . Crypt::encrypt(2)) !!}" class="btn-orange shadow_con">{{ hst_lang('hstcms::install.start.install') }}</a>
    </div>
</footer>
<script>
Hstcms.use('jquery', 'common', function(){
    
});
</script>
</body>
</html>

