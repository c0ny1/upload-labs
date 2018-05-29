
<?php
//循环删除目录和文件函数
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
function delDirAndFile($dirName){
	$n_success = 0;
	$n_fail = 0;
	if($handle = opendir("$dirName")){
		while( false !== ($item = readdir($handle))){
			if($item != "." && $item != ".."){
				if (is_dir("$dirName/$item")) {
					delDirAndFile("$dirName/$item");
				}else{
					if(unlink("$dirName/$item")){
						//echo "成功删除文件： $dirName/$item<br />n";
						$n_success++;
					}else{
						$n_fail++;
					}
				}
			}
		}
		closedir( $handle );
		if(rmdir($dirName)){
			//echo "成功删除目录： $dirName<br />n";
			$n_success++;
		}else{
			$n_fail++;
		}
		return '删除成功：'.$n_success.'，删除失败：'.$n_fail.'！';
	}
}

if($_GET['action'] == 'clean_upload_file'){
	echo delDirAndFile("upload");
	mkdir("upload");
}
?>