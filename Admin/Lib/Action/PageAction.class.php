<?php
/**
 * 单页管理  -- Controller
 *********************************/
class PageAction extends CommonAction {
	
	/**
	 +---------------------------------
	 * 单页数据  -- View
	 +---------------------------------*/
	public function page_data(){
    	$cid = $this->_get('cid', 'intval');
    	$this->page_info = M('page')->where('cid ='.$cid)->find();
    	//默认字段状态
    	$str = "1|1|1|1|1|1";
    	$is_cid_list = M('menu')->where("show_default_fields<>'' and id=".$cid)->find();
    	if($is_cid_list) { $is_cid_list_str = $is_cid_list['show_default_fields']; }
    	$show_default_fields_status = explode('|', $is_cid_list_str);
    	$this->assign('show_default_fields_status', $show_default_fields_status);
    	//栏目扩展的字段  - select
    	$this->menu_extend_show_list = M('page_extend_show')->join(C('DB_PREFIX').'page_extend_fields on '.C('DB_PREFIX').'page_extend_show.field_id='.C('DB_PREFIX').'page_extend_fields.field_id')->where(C('DB_PREFIX').'page_extend_show.is_show=1 and '.C('DB_PREFIX').'page_extend_show.cid='.$cid)->field(C('DB_PREFIX').'page_extend_fields.*')->order(C('DB_PREFIX').'page_extend_fields.sort')->select();
    	$this->assign('cid', $cid);
    	$this->display();
	}

	/**
	 +---------------------------------
	 * 添加单页  -- Model
	 +---------------------------------*/
    public function page_add(){
    	if(IS_POST){
    		$db = M('page');
    		$cid = $this->_post('cid', 'intval');
    		$data = $_POST['info'];
    		$data['title'] = strip_tags($data['title']);
    		$data['published'] = time();
    		if(empty($data['title'])){
    			echo json_encode(array('status' => 0, 'info' => "请输入标题！", 'url'=>__SELF__));
    			exit;
    		}
    		if (!empty($data['content'])) { //反转义
    			$data['content'] = stripslashes($data['content']);
    		}
    		//扩展字段数据处理
    		$menu_extend_show_list = M('page_extend_show')->join(C('DB_PREFIX').'page_extend_fields on '.C('DB_PREFIX').'page_extend_show.field_id='.C('DB_PREFIX').'page_extend_fields.field_id')->where(C('DB_PREFIX').'page_extend_show.is_show=1 and '.C('DB_PREFIX').'page_extend_show.cid='.$cid)->field(C('DB_PREFIX').'page_extend_fields.*')->order(C('DB_PREFIX').'page_extend_fields.sort')->select();
    		foreach($menu_extend_show_list as $k=>$v){
    			if(isset($_POST[$v['field_name']])){
    				if(is_array($_POST[$v['field_name']])){
    					$data[$v['field_name']] = trim(join(',',$_POST[$v['field_name']]));
    				}else {
    					$data[$v['field_name']] = trim($_POST[$v['field_name']]);
    				}
    			}
    		}
    		
    		if ($db->add($data)) {
    			echo json_encode(array('status' => 1, 'info' => "已经发布", 'url' => U('Page/page_data', array('cid' => $data['cid']))));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作", 'url'=>__SELF__));
    		}
    	}
    }   
     
	/**
	 +---------------------------------
	 * 编辑数据处理 -- Model
	 +---------------------------------*/
	public function page_edit(){
		if(IS_POST){
			$db = M('page');
			$cid = $this->_post('cid', 'intval');
			$data = $_POST['info'];
			$data['title'] = strip_tags($data['title']);
			$data['published'] = time();
			if(empty($data['title'])){
				echo json_encode(array('status' => 0, 'info' => "请输入标题！", 'url'=>__SELF__));
				exit;
			}
			if (!empty($data['content'])) { //反转义
				$data['content'] = stripslashes($data['content']);
			}
			//扩展字段数据处理
			$menu_extend_show_list = M('page_extend_show')->join(C('DB_PREFIX').'page_extend_fields on '.C('DB_PREFIX').'page_extend_show.field_id='.C('DB_PREFIX').'page_extend_fields.field_id')->where(C('DB_PREFIX').'page_extend_show.is_show=1 and '.C('DB_PREFIX').'page_extend_show.cid='.$cid)->field(C('DB_PREFIX').'page_extend_fields.*')->order(C('DB_PREFIX').'page_extend_fields.sort')->select();
			foreach($menu_extend_show_list as $k=>$v){
				if(isset($_POST[$v['field_name']])){
					if(is_array($_POST[$v['field_name']])){
						$data[$v['field_name']] = trim(join(',',$_POST[$v['field_name']]));
					}else {
						$data[$v['field_name']] = trim($_POST[$v['field_name']]);
					}
				}
			}
			
			if ($db->where('cid='.$cid)->save($data)) {
				echo json_encode(array('status' => 1, 'info' => "更新成功", 'url' => U('Page/page_data', array('cid' => $cid))));
			} else {
				echo json_encode(array('status' => 0, 'info' => "更新失败，请重试..."));
			}
			
		}
	}
}