<?php
/**
 * 留言内容模型管理  -- Controller
 *********************************/
class MessageContentModelAction extends CommonAction {

	/**
	 +---------------------------------
	 * 留言模型  -- View
	 +---------------------------------*/
    public function message_model_list(){
    	if(IS_POST){
    		$sort = $this->_post('sort', 'intval');
    		$db = M("message_extend_fields"); // 实例化category对象
    		 
    		foreach($sort as $k=>$v){
    			// 要修改的数据对象属性赋值
    			$data['sort'] = $v;
    			$do_rs[] = $db->where('field_id='.$k)->save($data); //根据条件保存修改的数据
    		}
    		
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U('MessageContentModel/message_model_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U('MessageContentModel/message_model_list')));
    		}
    	}else{
    		$db = M('message_extend_fields'); // 实例化User对象
    		import('ORG.Util.Page'); 	 // 导入分页类
    		$count = $db->count(); 		 // 查询满足要求的总记录数
    		$Page  = new Page($count,8); // 实例化分页类 传入总记录数和每页显示的记录数
    		$show  = $Page->show(); // 分页显示输出
    		$message_extend_fields_list = $db->order('sort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$this->assign('message_extend_fields_list',$message_extend_fields_list); // 赋值数据集
    		$this->assign('page',$show); // 赋值分页输出
    		$this->display();  
    	}
    }
  
	/**
	 +---------------------------------
	 * 添加留言模型字段  -- View
	 +---------------------------------*/
    public function message_model_add(){
    	if(IS_POST){
    		$field_name = $this->_post('field_name', 'htmlspecialchars'); //字段名称
    		
    		$data = array();
    		$db = M('message_extend_fields');
    		if($field_name == ''){$this->error('请输入字段名称');}
    		$data = $_POST;
    		//为空随便创建
			if(trim($_POST['default_option']) !=''){
				//字符串走字符串判断
				if(is_string(trim($_POST['default_option']))){
					//单行文本  多选列表  多选按钮 文件上传      varchar(255)
					if($_POST['field_type'] == 0 || $_POST['field_type'] == 5 || $_POST['field_type'] == 6 || $_POST['field_type'] == 7){
						$sql = "ALTER TABLE ".C('DB_PREFIX')."message ADD ".trim($field_name)." varchar(255) NOT NULL DEFAULT '".trim($_POST['default_option'])."';";
					}else{
					//多行文本不支持编辑器  多行文本支持编辑器 text
						$sql = "ALTER TABLE ".C('DB_PREFIX')."message ADD ".trim($field_name)." text(0) CHARACTER SET utf8;";
					}
				}else{
					//下拉列表菜单 单选按钮  tinyint
					$sql = "ALTER TABLE ".C('DB_PREFIX')."message ADD ".trim($field_name)." tinyint(1) NOT NULL DEFAULT ".trim($_POST['default_option']).";";
				}
			}else{
				$sql = "ALTER TABLE ".C('DB_PREFIX')."message ADD ".trim($field_name)." text(0) CHARACTER SET utf8;";
			}
    		$Model = new Model();
    		$rs = $Model->execute($sql);
    		//if($rs){
    			if($db->create()){
    				$db->add($data);
    				echo json_encode(array('status' => 1, 'info' => '添加扩展字段成功', 'url' => U('MessageContentModel/message_model_list')));
    			}else{
    				echo json_encode(array('status' => 0, 'info' => ''.$db->getError()));
    			}
    		//}else{
    			//echo json_encode(array('status' => 0, 'info' => '已经存在该字段或数据非法!'));
    		//}
    	}else{
			//获取扩展字段类型
    		$this->assign('list_type',C('FIELD_TYPE'));
    		$this->display();
    	}
    }

	/**
	 +---------------------------------
	 * 编辑留言模型字段  -- View
	 +---------------------------------*/
    public function message_model_edit(){
    	if(IS_POST){
    		$field_name = $this->_post('field_name', 'htmlspecialchars'); //字段名称

    		$db = M('message_extend_fields');
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
    		//为空随便创建
    		if(trim($_POST['default_option']) !=''){
    			//字符串走字符串判断
    			if(is_string(trim($_POST['default_option']))){
    				//单行文本  多选列表  多选按钮 文件上传      varchar(255)
    				if($_POST['field_type'] == 0 || $_POST['field_type'] == 5 || $_POST['field_type'] == 6 || $_POST['field_type'] == 7){
    					$sql = "ALTER TABLE ".C('DB_PREFIX')."message change ".$test_info['field_name']." ".trim($field_name)." varchar(255) NOT NULL DEFAULT '".trim($_POST['default_option'])."';";
    				}else{
    					//多行文本不支持编辑器  多行文本支持编辑器 text
    					$sql = "ALTER TABLE ".C('DB_PREFIX')."message change ".$test_info['field_name']." ".trim($field_name)." text(0) CHARACTER SET utf8;";
    				}
    			}else{
    				//下拉列表菜单 单选按钮  tinyint
    				$sql = "ALTER TABLE ".C('DB_PREFIX')."message change ".$test_info['field_name']." ".trim($field_name)." tinyint(1) NOT NULL DEFAULT ".trim($_POST['default_option']).";";
    			}
    		}else{
    			$sql = "ALTER TABLE ".C('DB_PREFIX')."message change ".$test_info['field_name']." ".trim($field_name)." text(0) CHARACTER SET utf8;";
    		}
    		$Model = new Model();
    		$rs = $Model->execute($sql);
    		//if($rs){
    			if($db->where('field_id='.$field_id)->save($data)){
    				echo json_encode(array('status' => 1, 'info' => '更新扩展字段成功', 'url' => U('MessageContentModel/message_model_list')));
    			}else{
    				echo json_encode(array('status' => 0, 'info' => ''.$db->getError()));
    			}
    		//}else{
    			//echo json_encode(array('status' => 0, 'info' => '已经存在该字段或数据非法!11__'.$sql));
    		//}
    	}else{
    		$id = $this->_get('id', 'intval');
    		$this->message_extend_fields_info = M('message_extend_fields')->where('field_id='.$id)->find();

    		//获取扩展字段类型
    		$this->assign('list_type',C('FIELD_TYPE'));
    		
    		$this->assign('id', $id);
    		$this->display('message_model_add');
    	}
    }

	/**
	 +---------------------------------
	 * 删除留言模型字段  -- View
	 +---------------------------------*/
    public function message_model_del(){
    	$id = $this->_get('id', 'intval');
    	if(!empty($id)){
    
    		$sql = "ALTER TABLE ".C('DB_PREFIX')."page DROP COLUMN ".trim($_REQUEST['field_name']);
    		$t = M()->execute($sql);
    		//if($t){
    			$rs =  M('message_extend_fields')->where('field_id='.$id)->delete();
    			if (!empty($rs)) {
					$last_rs =  M('message_extend_show')->where('field_id='.$id)->delete();
					if (!empty($rs)) {
    					echo json_encode(array('status' => 1, 'info' => '删除成功'));
					} else {
						echo json_encode(array('status' => 0, 'info' => '删除失败'));
					}
    			} else {
    				echo json_encode(array('status' => 0, 'info' => '删除失败'));
    			}
    		//}else{
    			//echo json_encode(array('status' => 0, 'info' => '删除失败'));
    		//}
    	}else{
    		echo json_encode(array('status' => 0, 'info' => '非法操作、' . '删除失败'));
    	}
    }

}