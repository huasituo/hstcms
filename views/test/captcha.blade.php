<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta name="viewport" content="initial-scale=0.1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ config('hstcms.resurl') }}/css/hstui.min.css" />
	<title>{!! hst_lang('captcha::public.captcha') !!}</title>
	<script>
	var G = {
		RES_ROOT: '{{ config('hstcms.resurl') }}',
		TIPS_MESSAGE: {
			STATE : '{!! session('state') !!}',
			MESSAGE : '{!! session('message') !!}',
		}
	}
	</script>
	<script type="text/javascript" src="{{ config('hstcms.resurl') }}/js/hstui.min.js"></script>
	</head>
	<body>
		<img src="{{ route('captchaIndexGet', ['w'=>120, 'h'=>40]) }}" id="code">
		<button  class="hstui-button J_getNewCode">{!! hst_lang('hstcms::captcha.change.one') !!}</button>
		
		<form action="{{ route('hstcmsCaptchaTestCheck') }}" method="post">
		{{ hst_csrf() }}
		<input type="text" name="code" class="hstui-input">
		@if($errors->has('code'))
			<p>{!! $errors->first('code') !!}</p>
		@endif
		<button type="submit" class="hstui-button">{!! hst_lang('hstcms::public.checks') !!}</button>
			
		</form>
	
		<script>
			var codeUrl = '{{ route('captchaIndexGet', ['w'=>120, 'h'=>40]) }}';
			Hstui.use('jquery', 'common', function(){
				$(".J_getNewCode").on('click',function(){
					$("#code").attr('src', codeUrl + '?t='+Date.parse(new Date()));
				});
			});
		</script>
	</body>
</html>