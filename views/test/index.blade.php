<!DOCTYPE html>
<html>
<head>
@include('hstcms::common.head')
</head>
<body>
<form method="post" action="{{ route('hstcmsTextIndexPost') }}" enctype="multipart/form-data">
    {!! hst_csrf() !!} 
	<input type="file" name="image">
	<button type="submit" value="提交">提交</button>
</form>
<style>


</style>
<!-- <img src="{{ hst_image_resize(229, ['width'=>100, 'height'=>100, 'type'=>'force']) }}" style="width: 100px">


<img src="{{ route('imageView', ['aid'=>231]) }}" style="width: 100px">
<img src="{{ route('imageResize', ['aid'=>231, 'width'=>130, 'height'=>130, 'type'=>'resize']) }}" style="width: 100px"> -->
		
		<div class="hstui-upload J_upload"></div>
		<div class="hstui-upload J_uploads"></div>
<a href="" ></a>

<!-- 		<div class="hstui-button hstui-button-danger hstui-button-upload">
			<i class="hstui-icon hstui-icon-upload"></i>选择上传文件
			<input type="file" class="J_upload" id="filedata" data-idname="image" data-name="image" />
		</div> -->
		<span id="hstui-upload-queue-item-tips_image"></span>
		<span id="uploadpercents"></span>
		<div id="upload_list_image" class="upload_list">
<!-- 			<li class="hstui-upload-queue-item">
				<img src="http://pic.58.com/p1/big/n_v20b485ccd46c34831b6fc8617cd49135d_130_100.jpg">
				<div class="image_cover"></div>
				<div class="toolbar_wrap">	
					<div class="opacity"></div>	
					<div class="toolbar">		
						<a href="javascript:;" class="edit hstui-icon hstui-icon-compose" id=""></a>		
						<a href="javascript:;" class="delete hstui-icon hstui-icon-trash"></a>	
					</div>
				</div>
				<div class="hstui-upload-queue-item-tips">
					<span class="hstui-upload-queue-item-tips_content"></span>
					<span class="hstui-icon hstui-spinner"></span>
					<p>23%</p>
				</div>
			</li>
			<li class="hstui-upload-queue-item">
				<img src="http://pic.58.com/p1/big/n_v20b485ccd46c34831b6fc8617cd49135d_130_100.jpg">
				<div class="image_cover"></div>
				<div class="toolbar_wrap">	
					<div class="opacity"></div>	
					<div class="toolbar">		
						<a href="javascript:;" class="edit hstui-icon hstui-icon-compose" id=""></a>		
						<a href="javascript:;" class="delete hstui-icon hstui-icon-trash"></a>	
					</div>
				</div>
				<div class="hstui-upload-queue-item-tips hstui-upload-queue-item-tips_deng">
					<p class="hstui-upload-queue-item-tips_content">等待上传</p>
				</div>
			</li> -->
		</div>
		<div id="upload_list_image" class="upload_list">
			<li class="file_box">
				<!-- <img src="http://pic.58.com/p1/big/n_v20b485ccd46c34831b6fc8617cd49135d_130_100.jpg">
				<input type="text" class="hstui-input" name="">
				<span class="hstui-upload-queue-item-tips"></span> -->
			</li>
		</div>
		<input type="text" id="hstcms_image" name="">
<script>
			Hstui.use('jquery', 'common', 'upload', function() {
					// $(".J_upload").hstuiUpload({
					// 	uploadNum: 5,
					// 	uploadUrl: 'http://www.huasituo.com/test/post',
					// 	uploadData: {
					// 		_token: $("input[name='_token']").val()
					// 	},
					// 	uploadProgress:function(e,p,t,r) {

					// 	}
					// });
					$(".J_upload").hstuiUpload({
						// uploadNum: 5,
						fileName: 'filedata',
						fName: 'tu',
						isedit: true,
						url: 'http://www.huasituo.com/test/post',
						dataList: [{"aid":215,"name":"1225px(1).png","type":"png","size":21102,"path":"2018\/05\/28\/8b444a9dfba5c6fdfe58f63d87717171.png","ifthumb":0,"created_userid":0,"created_time":1527498262,"app":"form_ceshi","app_id":12,"descrip":"","disk":"public","url":"http:\/\/www.huasituo.com\/storage\/2018\/05\/28\/8b444a9dfba5c6fdfe58f63d87717171.png"},{"aid":216,"name":"down.png","type":"png","size":149,"path":"2018\/05\/28\/9e38550bbf5c68fb947f785ad67b9c4a.png","ifthumb":0,"created_userid":0,"created_time":1527498264,"app":"form_ceshi","app_id":12,"descrip":"","disk":"public","url":"http:\/\/www.huasituo.com\/storage\/2018\/05\/28\/9e38550bbf5c68fb947f785ad67b9c4a.png"}],
						formParam: {
							_token: $("input[name='_token']").val()
						},
						// uploadProgress:function(e,p,t,r) {

						// }
					});
					$(".J_uploads").hstuiUpload({
						autoUpload: true,
						multi: false,
						fileName: 'filedata',
						fName: 'image',
						// dataList: [{"aid":215,"name":"1225px(1).png","type":"png","size":21102,"path":"2018\/05\/28\/8b444a9dfba5c6fdfe58f63d87717171.png","ifthumb":0,"created_userid":0,"created_time":1527498262,"app":"form_ceshi","app_id":12,"descrip":"","disk":"public","url":"http:\/\/www.huasituo.com\/storage\/2018\/05\/28\/8b444a9dfba5c6fdfe58f63d87717171.png"},{"aid":216,"name":"down.png","type":"png","size":149,"path":"2018\/05\/28\/9e38550bbf5c68fb947f785ad67b9c4a.png","ifthumb":0,"created_userid":0,"created_time":1527498264,"app":"form_ceshi","app_id":12,"descrip":"","disk":"public","url":"http:\/\/www.huasituo.com\/storage\/2018\/05\/28\/9e38550bbf5c68fb947f785ad67b9c4a.png"}],
						queue: {
							width: 300,
							itemWidth:'300',
							itemHeight:'200',
						},
						showNote: '请上传8m以内文件',
						url: 'http://www.huasituo.com/test/post',
						formParam: {
						},
						// uploadProgress:function(e,p,t,r) {

						// }
				})
			})
		</script>
</body>
</html>