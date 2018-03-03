<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="post" action="{{ route('hstcmsTextIndexPost') }}" enctype="multipart/form-data">
    {!! hst_csrf() !!} 
	<input type="file" name="image">
	<button type="submit" value="提交">提交</button>
</form>
</body>
</html>