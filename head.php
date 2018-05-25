<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<link rel="icon" type="image/x-icon" href="<?php echo $site_root;?>/img/resizeApi.png" />  
	<title>upload-labs</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo $site_root;?>/css/index.css">
<link rel="stylesheet" type="text/css" href="<?php echo $site_root;?>/css/prism.css">
<script>
function show_code(){
	var url = window.location.href;
	if(url.indexOf("?") != -1){
		url = url.split("?")[0];
	}	

	var e = document.getElementById("show_code");
	if(e == null){
		window.location.href=url+"?action=show_code";
	}else{
		window.location.href=url;
	}
}
</script>
<body>
	<div id="head">
		<a href="<?php echo $site_root;?>"><img src="<?php echo $site_root;?>/img/logo.png"/></a>
		<div id="head_menu">
			<a href="javascript:show_code()">查看源码</a>
			<a href="javascript:get_prompt()">查看提示</a>
			<a href="javascript:clean_upload_file()">清空上传文件</a>
		</div>
	</div>
	<div id="main">