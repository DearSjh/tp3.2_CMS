<?php
class CommonAction extends Action{
	
	public function _initialize(){
		
		if (!isset($_SESSION['jkd_uid']) || !isset($_SESSION['jkd_uname'])){
			$this->redirect('Login/login');
		}
		
	}

	/**
	 +---------------------------------
	 * 注销登录
	 +---------------------------------*/
	public function loginOut(){
		session_unset();
		session_destroy();
		$this->redirect('Login/login');
	}
	
}