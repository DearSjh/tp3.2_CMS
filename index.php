<?php



/* define("WEB_ROOT", dirname(__FILE__) . "/");
if (!file_exists(WEB_ROOT.'install/install.lock')) {
	header("Location: install/");
	exit;
} */

include './Conf/developer.php';

if($developer['is_mobile']){  //开启手机跳转
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";
	if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
	{
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$is_ipad = (strpos($agent, 'ipad')) ? true : false;
		if(!$is_ipad){
			header('Location: /wap.php');
			exit;
		}
	}
};

if($developer['is_debug']){	   //定义开启调试模式
	define('APP_DEBUG',True);			
};

define('APP_NAME','Home');	   //定义项目名称
define('APP_PATH','./Home/');  //定义项目路径

//加载框架入文件
include './Public/core/_core.php';


?>
