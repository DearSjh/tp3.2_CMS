<?php
/**
 * 开发者模式  -- Controller
 *********************************/
class DevAction extends CommonAction {
	
	/**
	 +---------------------------------
	 * 内容模型管理  -- View
	 +---------------------------------*/
    public function contentModel(){
    	$this->display();
    }

	/**
	 +---------------------------------
	 * 后台导航管理   -- View
	 +---------------------------------*/
    public function admin_nav(){
    	$this->display();
    }  
      
	/**
	 +---------------------------------
	 * 后台导航列表  -- View
	 +---------------------------------*/
    public function admin_nav_list(){
    	$cid = $this->_get('cid', 'intval');
    	if(IS_POST){
    		$sort = $this->_post('sort', 'intval');
    		$db = M("admin_nav"); // 实例化category对象
    		 
    		foreach($sort as $k=>$v){
    			// 要修改的数据对象属性赋值
    			$data['sort'] = $v;
    			$do_rs[] = $db->where('id='.$k)->save($data); //根据条件保存修改的数据
    		}
    		
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U('Dev/admin_nav_list', array('cid' => $cid))));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U('Dev/admin_nav_list', array('cid' => $cid))));
    		}
    	}else {
	    	$this->admin_nav_list = M('admin_nav')->where('nav_type='.$cid)->order('sort asc')->select();
		    $this->assign('cid', $cid);
	    	$this->display();
    	}
    } 
    
	/**
	 +---------------------------------
	 * 后台导航添加  -- View
	 +---------------------------------*/
    public function admin_nav_add(){
    	if(IS_POST){
    		$db = M('admin_nav');
    		$data = $_POST;
    		if ($db->add($data)) {
    			echo json_encode(array('status' => 1, 'info' => "添加成功", 'url' => U('Dev/admin_nav_list', array('cid' => $data['nav_type']))));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "添加失败", 'url'=>__SELF__));
    		}
    	}else{
	    	$this->display();
    	}
    }   
    
	/**
	 +---------------------------------
	 * 后台导航编辑  -- View
	 +---------------------------------*/
    public function admin_nav_edit(){
    	if(IS_POST){
    		$db = M('admin_nav');
    		$id = $this->_get('id', 'intval');
    		$data = $_POST;
    		if ($db->where('id='.$id)->save($data)) {
    			echo json_encode(array('status' => 1, 'info' => "更新成功", 'url' => U('Dev/admin_nav_list', array('cid' => $data['nav_type']))));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "更新失败", 'url'=>__SELF__));
    		}
    	}else{
    		$id = $this->_get('id', 'intval');
    		$this->admin_nav_list = M('admin_nav')->where('id='.$id)->find();
    		$this->display('admin_nav_add');
    	}
    }
    
	/**
	 +---------------------------------
	 * 后台导航删除  -- View
	 +---------------------------------*/
    public function admin_nav_del(){
    	$id = $this->_get('id', 'intval');
    	if(!empty($id)){
    		$rs =  M('admin_nav')->where('id='.$id)->delete();
    		if (!empty($rs)) {
    			echo json_encode(array('status' => 1, 'info' => '删除成功'));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '删除失败'));
    		}
    	}else{
    		echo json_encode(array('status' => 0, 'info' => '非法操作、' . '删除失败'));
    	}
    }
  
}