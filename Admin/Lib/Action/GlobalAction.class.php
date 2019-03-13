<?php

/**
 * 全局管理  -- Controller
 *********************************/
class GlobalAction extends CommonAction {
	
	/**
	 +---------------------------------
	 * 站点配置
	 +---------------------------------*/
    public function site_conf(){
    	if(IS_POST){
    		$file = './Conf/config.php';
    		//提交数据转换为大写并将两个数组合并为一个数据
    		$config = array_merge(include $file, array_change_key_case($_POST, CASE_UPPER));
    		//var_export — 输出或返回一个变量的字符串表示
    		$str = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
    		if (file_put_contents($file, $str)) {
    			echo json_encode(array('status' => 1, 'info' => '站点配置' . '已更新'));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '站点配置' . '更新失败'));
    		}    		
    	}else{
       		//栏目扩展的字段  - select
    		$this->site_extend_show_list = M('site_conf_extend_fields')->where('is_show = 1')->select();
    		$this->display();
    	}
    }
    
    /**
	 +---------------------------------
	 * 站点配置模型列表
	 +---------------------------------*/
    public function site_conf_model_list(){
    	if(IS_POST){
    		$sort = $this->_post('sort', 'intval');
    		$db = M("site_conf_extend_fields"); // 实例化category对象
    		 
    		foreach($sort as $k=>$v){
    			// 要修改的数据对象属性赋值
    			$data['sort'] = $v;
    			$do_rs[] = $db->where('field_id='.$k)->save($data); //根据条件保存修改的数据
    		}
    		
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U('Global/site_conf_model_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U('Global/site_conf_model_list')));
    		}
    	}else{
    		$db = M('site_conf_extend_fields'); // 实例化User对象
    		import('ORG.Util.Page'); 	 // 导入分页类
    		$count = $db->count(); 		 // 查询满足要求的总记录数
    		$Page  = new Page($count,8); // 实例化分页类 传入总记录数和每页显示的记录数
    		$show  = $Page->show(); // 分页显示输出
    		$site_conf_extend_fields_list = $db->order('sort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$this->assign('site_conf_extend_fields_list',$site_conf_extend_fields_list); // 赋值数据集
    		$this->assign('page',$show); // 赋值分页输出
    		$this->display();  
    	}
    }
    


    /**
     +---------------------------------
     * 添加文章模型字段
     +---------------------------------*/
    public function site_conf_model_add(){
    	if(IS_POST){
    		$field_name = $this->_post('field_name', 'htmlspecialchars'); //字段名称
    
    		$data = array();
    		$db = M('site_conf_extend_fields');
    		if($field_name == ''){$this->error('请输入字段名称');}
    		$data = $_POST;
    		if($db->add($data)){
    			echo json_encode(array('status' => 1, 'info' => '添加扩展字段成功', 'url' => U('Global/site_conf_model_list')));
    		}else{
    			echo json_encode(array('status' => 0, 'info' => ''.$db->getError()));
    		}
    	}else{
    		//获取扩展字段类型
    		$this->assign('list_type',C('FIELD_TYPE_TWO'));
    		$this->display();
    	}
    }
    
    
    /**
     +---------------------------------
     * 编辑文章模型字段
     +---------------------------------*/
    public function site_conf_model_edit(){
    	if(IS_POST){
    		$field_name = $this->_post('field_name', 'htmlspecialchars'); //字段名称
    
    		$db = M('site_conf_extend_fields');
    		//初步检测
    		$field_id = $this->_post('id', 'intval');
    		$test_info = $db->where('field_id='.$field_id)->find();
    		if(!$test_info){
    			echo json_encode(array('status' => 0, 'info' => '找不到该字段'));
    			exit;
    		}
    		$data = array();
    		if($field_name == ''){$this->error('请输入字段名称');}
    		$data = $_POST;
    		if($db->where('field_id='.$field_id)->save($data)){
    			echo json_encode(array('status' => 1, 'info' => '更新扩展字段成功', 'url' => U('Global/site_conf_model_list')));
    		}else{
    			echo json_encode(array('status' => 0, 'info' => ''.$db->getError()));
    		}
    	}else{
    		$id = $this->_get('id', 'intval');
    		$this->site_conf_extend_fields_info = M('site_conf_extend_fields')->where('field_id='.$id)->find();
    
    		//获取扩展字段类型
    		$this->assign('list_type',C('FIELD_TYPE_TWO'));
    
    		$this->assign('id', $id);
    		$this->display('site_conf_model_add');
    	}
    }
    
    
    /**
     +---------------------------------
     * 删除文章模型字段
     +---------------------------------*/
    public function site_conf_model_del(){
    	$id = $this->_get('id', 'intval');
    	if(!empty($id)){
    		$rs =  M('site_conf_extend_fields')->where('field_id='.$id)->delete();
    		if (!empty($rs)) {
    			echo json_encode(array('status' => 1, 'info' => '删除成功'));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '删除失败'));
    		}
    	}else{
    		echo json_encode(array('status' => 0, 'info' => '非法操作、' . '删除失败'));
    	}
    }
    
    /**
     +---------------------------------
     * 安全配置
     +---------------------------------*/
    public function safety_conf(){
    	if(IS_POST){
    		$username  = $this->_post('username', 'htmlspecialchats'); //用户名
    		$pwd_command  = $this->_post('pwd_command', 'htmlspecialchats'); //口令
    		$password  = $this->_post('password', 'htmlspecialchats'); //密码
    		$cfm_password  = $this->_post('cfm_password', 'htmlspecialchats'); //确认密码
    		$question_id  = $this->_post('question_id', 'intval'); //安全提问
    		$question_answer  = $this->_post('question_answer', 'htmlspecialchats'); //安全问题答案
    		
    		if('9kd' != $pwd_command){
    			echo json_encode(array('status' => 0, 'info' => '对不起、您输入的非正确口令、如遗忘请联系开发商'));
    			exit;
    		}
    		
    		if($password != $cfm_password){
    			echo json_encode(array('status' => 0, 'info' => '对不起、您两次输入的密码不一致'));
    			exit;
    		}
    		
    		if(empty($password)){
    			echo json_encode(array('status' => 0, 'info' => '对不起、管理员密码不能为空！'));
    			exit;
    		}
    		
    		if(empty($question_answer)){
    			echo json_encode(array('status' => 0, 'info' => '安全问题答案不能为空！'));
    			exit;
    		}
    		
    		$rs_pwd = md5($password.C('LOGIN_TO_KEY'));
    		$db = M('admin');
    		if(!empty($username)){
    			$data = array(
    				'username' => $username,
    				'password' => $rs_pwd,
    				'question_id' => $question_id,
    				'question_answer' => $question_answer,
    			);
    			$do_rs = $db->where('id=1')->save($data);
    		}else{
    			$data = array(
    				'password' => $rs_pwd,
    				'question_id' => $question_id,
    				'question_answer' => $question_answer,
    			);
    			$do_rs = $db->where('id=1')->save($data);
    		}
    		
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			session_unset();
    			session_destroy();
    			echo json_encode(array('status' => 1, 'info' => '账户密码更新成功、请重新登录', 'url' => U('Login/login')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '修改失败，请重试...'));
    		}
    	}else{
    		$this->display();
    	}
    }
    
    /**
     +---------------------------------
     * 系统配置
     +---------------------------------*/
    public function system_conf(){
    	if(IS_POST){
    		$file = './Conf/config.php';
    		//提交数据转换为大写并将两个数组合并为一个数据
    		$config = array_merge(include $file, array_change_key_case($_POST, CASE_UPPER));
    		//var_export — 输出或返回一个变量的字符串表示
    		$str = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";

    		$file2 = './Conf/developer.php';
    		$data = "<?php \$developer = array( 'is_mobile' => ".$_POST['is_mobile'].", 'is_debug' => ".$_POST['is_debug'].", 'is_developer' => ". $_POST['is_developer']." ) ?>";
    		if (file_put_contents($file, $str)) {
    			file_put_contents($file2, $data);
    			echo json_encode(array('status' => 1, 'info' => '系统配置' . '已更新'));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '系统配置' . '更新失败'));
    		}
    	}else{
    		$this->display();
    	}
    }
    
    /**
     +---------------------------------
     * 修改后台入口管理
     +---------------------------------*/
    public function go_admin(){
    	if(IS_POST){
    		$post_old_admin_name = $this->_post('old_admin_name');
    		$post_new_admin_name = $this->_post('new_admin_name');
    		$old_admin_name = $post_old_admin_name.".php";
    		$new_admin_name = $post_new_admin_name.".php";
    		

    		if(empty($post_old_admin_name)){
    			echo json_encode(array('status' => 0, 'info' => '旧入口名不能为空！'));
    			exit;
    		}
    		
    		if(empty($post_new_admin_name)){
    			echo json_encode(array('status' => 0, 'info' => '新入口名不能为空！'));
    			exit;
    		}
    		
    		if(rename($post_old_admin_name, $old_admin_name)){
    			echo json_encode(array('status' => 1, 'info' => '更新成功'));
    		}else{
    			echo json_encode(array('status' => 0, 'info' => '更新失败'));
    		}
    	}else{
    		$this->display();
    	}
    }
    
    
}