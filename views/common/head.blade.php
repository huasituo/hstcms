<meta charset="UTF-8" />
<title></title>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="generator" content="hstcms v{!! config('hstcms:version') !!} 20171111" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="initial-scale=0.1">
<link rel="shortcut icon" href="{{ hst_public('favicon.ico') }}" />
<link rel="stylesheet" type="text/css" href="{{ config('hstcms.resurl') }}/css/hstui.min.css" />
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