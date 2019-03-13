<?php

/**
 * 后台登陆  Controller
 * */
class LoginAction extends Action{
	
	/**
	 +---------------------------------
	 * 加载登陆界面默认 View
	 +---------------------------------*/
	public function login(){
		if(IS_POST){
			$username = $this->_post('login_username');		 //接受用户名
			$post_pwd = $this->_post('login_password','htmlspecialchars');
			$pwd = md5($post_pwd.C('LOGIN_TO_KEY')); 		//接受用户密码并进行二次加密
			$question_id = $this->_post('question_id', 'intval');		 //安全问题ID
			$question_answer = $this->_post('question_answer', 'htmlspecialchars'); //安全问题答案
			
			$user = M('admin')->where(array('username' => $username))->find();
			

			if (!$user || $pwd != $user['password']){
				echo json_encode(array('status' => 0, 'info' => '用户名或密码错误'));
				exit;
			}
			
			if (!$user || $user['question_id'] != $question_id){
				echo json_encode(array('status' => 0, 'info' => '请选择正确的安全问题'));
				exit;
			}
			
			if (!$user || $user['question_answer'] != $question_answer){
				echo json_encode(array('status' => 0, 'info' => '请输入正确的安全问题答案'));
				exit;
			}
			
			$data = array(
				'id'=>$user['id'],
				'logintime' => time(),
				'loginip' => get_client_ip()
			);
			//更新管理员信息
			M('admin')->save($data);
			
			//保存session中
			session('jkd_uid',$user['id']);
			session('jkd_uname',$user['username']);
			session('jkd_logintime',date('Y-m-d H:i:s' ,$user['logintime']));
			session('jkd_loginip',$user['loginip']);
					
			echo json_encode(array('status' => 1, 'info' => '登陆成功', 'url' => U('Index/index')));
		}else{
			//用户已登陆再次访问跳转首页
			if (isset($_SESSION['jkd_uid']) || isset($_SESSION['jkd_uname'])){
				$this->redirect('Index/index');
			}
			$this->display();
		}
	}
	
	
}