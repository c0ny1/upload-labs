
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

if($_GET['action'] == 'clean_upload_file'){
	echo del_dir("upload");
	mkdir("upload");
}
?>