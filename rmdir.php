
<?php
//循环删除目录和文件函数
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
function del_dir($dir){
	$n_success = 0;
	$n_fail = 0;
	if($handle = opendir("$dir")){
		while( false !== ($item = readdir($handle))){
			if($item != "." && $item != ".."){
				if (is_dir("$dir/$item")) {
					del_dir("$dir/$item");
				}else{
					if(unlink("$dir/$item")){
						$n_success++;
					}else{
						$n_fail++;
					}
				}
			}
		}
		closedir( $handle );
		if(rmdir($dir)){
			$n_success++;
		}else{
			$n_fail++;
		}
		return '删除成功：'.$n_success.'，删除失败：'.$n_fail.'！';
	}
}

function touch_upload_readme(){
	$filepath = './upload/readme.php';
	file_put_contents($filepath,"<?php echo \"该目录是上传文件保存，该文件为系统说明文件，请勿删除！\";?>");
}

if($_GET['action'] == 'clean_upload_file'){
	echo del_dir("upload");
	//重新创建upload目录和readme.php文件
	sleep(0.5);
	mkdir("upload");
	touch_upload_readme();
}
?>