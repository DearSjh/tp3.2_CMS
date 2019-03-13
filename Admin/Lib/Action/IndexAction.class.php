<?php
/**
 * 后台首页 -- Controller
 *********************************/
class IndexAction extends CommonAction {
    public function index(){
    	$server_info = array(
    		'a' => PHP_OS,							//操作系统
			//主机名IP端口
    		'b' => $_SERVER['SERVER_NAME'] . ' (' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . ')',
    		'c' => $_SERVER["SERVER_SOFTWARE"], 	//运行环境
    		'd' => ini_get('upload_max_filesize'),	//上传附件限制
    	);
    	$this->assign('server_info', $server_info);
    	$this->display();
    }
}