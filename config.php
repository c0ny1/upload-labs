<?php
header("Content-type: text/html;charset=utf-8");
error_reporting(0);

define("WWW_ROOT",$_SERVER['DOCUMENT_ROOT']);
define("APP_ROOT",str_replace('\\','/',dirname(__FILE__)));
define("APP_URL_ROOT",str_replace(WWW_ROOT,"",APP_ROOT));

//设置上传目录
define("UPLOAD_PATH", "../upload/");
?>