<?php


/* define("WEB_ROOT", dirname(__FILE__) . "/");
if (!file_exists(WEB_ROOT.'install/install.lock')) {
	header("Location: install/");
	exit;
} */

define('APP_DEBUG',True);			//定义开启调试模式
define('APP_NAME','Admin');			//定义项目名称
define('APP_PATH','./Admin/');		//定义项目路径


//加载框架入文件
include './Public/core/_core.php';


?>
