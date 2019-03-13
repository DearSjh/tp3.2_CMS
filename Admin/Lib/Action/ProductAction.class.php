<?php
/**
 * 产品管理  -- Controller
 *********************************/
class ProductAction extends CommonAction {

	/**
	 +---------------------------------
	 * 产品列表  -- View
	 +---------------------------------*/
    public function product_list(){

    	import('Class.Category', APP_PATH);
    	
    	$cid = $this->_get('cid', 'intval');
    	if(empty($cid)){
    		$h_cid = $this->_get('h_cid', 'intval');
    		$nav_menu_list = M('menu')->order('sort')->select();
    		$cid_array = Category::get_all_last_parentsId($nav_menu_list, $h_cid); //获取顶级分类ID
    		$cid = $cid_array['id'];
    	}
    	
    	/**
    	 * 所属分类 s start -------------------------------------------------->*/
    	$fid_menu = M('menu')->field('id,pid')->where('id='.$cid)->find();
    	if(empty($fid_menu['pid'])){
    		$this->assign('is_top_menu_true', 1);
    		$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$cid." and content_model <>''")->select();
    	}else{
    		$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$fid_menu['pid']." and content_model <>''")->select();
    	}
    	/**
    	 * 所属分类 s end -------------------------------------------------->*/
    	
    	//条件搜索  顶级分类：显示所有子分类数据，  子分类：显示对应分类数据
    	if(empty($fid_menu['pid'])){
    		$menu_list_one = M('menu')->order('sort')->select();
    		$menu_list_one_two = Category::get_all_childsId($menu_list_one, $cid); //获取所有分类ID
    		$menu_list_one_two_three = implode(',', $menu_list_one_two);
    		if(!empty($menu_list_one_two_three)){
    			$menu_list_one_two_three.','.$cid;
    			$where .= " cid in (" . $menu_list_one_two_three . ")";
    		}else{
    			$where = 'cid = '.$cid;
    		}
    	}else{
    		$where = 'cid = '.$cid;
    	}

    	$title = $this->_get('title', 'htmlspecialchars');
    	$status = $this->_get('status', 'intval');
    	$is_m = $this->_get('is_m', 'intval');
//组合搜索 start----------------------------->
    	if(!empty($title)){ $where .= " AND product.title LIKE '%" . $title . "%'";}
    	if(!empty($status) && $status == 2){ $where .= " AND status = 2"; }
    	if(!empty($is_m) && $is_m == 2){ $where .= " AND is_m = 2"; }
    	$this->assign('s_title', $title);
    	$this->assign('s_status', $status);
    	$this->assign('s_is_m', $is_m);
//组合搜索 end----------------------------------------------------->
    	
//初始化数据	
    	$db = D('ProductView');
    	import('ORG.Util.Page');
    	$count = $db->where($where)->count();
    	$Page  = new Page($count,8);
    	$show  = $Page->show();
    	$this->product_list = $db->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('page',$show);
    	$this->assign('cid', $cid);
    	$this->display();  
    }

    
	/**
	 +---------------------------------
	 * 添加产品  -- View
	 +---------------------------------*/
    public function product_add(){
    	if(IS_POST){
    		$db = M('product');
    		$cid = $this->_post('cid', 'intval');
    		$data = $_POST['info'];
    		$data['title'] = strip_tags($data['title']);
    		$data['published'] = time();
    		if(empty($data['title'])){
    			echo json_encode(array('status' => 0, 'info' => "请输入标题！", 'url'=>__SELF__));
    			exit;
    		}
    		if (empty($data['summary'])) {
    			$data['summary'] = cutStr(strip_tags($data['content']), 200);
    		}
    		if (!empty($data['content'])) { //反转义
    			$data['content'] = stripslashes($data['content']);
    		}
    		//扩展字段数据处理
    		$menu_extend_show_list = M('product_extend_show')->join(C('DB_PREFIX').'product_extend_fields on '.C('DB_PREFIX').'product_extend_show.field_id='.C('DB_PREFIX').'product_extend_fields.field_id')->where(C('DB_PREFIX').'product_extend_show.is_show=1 and '.C('DB_PREFIX').'product_extend_show.cid='.$cid)->field(C('DB_PREFIX').'product_extend_fields.*')->order(C('DB_PREFIX').'product_extend_fields.sort')->select();
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
    			echo json_encode(array('status' => 1, 'info' => "已经发布", 'url' => U('Product/product_list', array('cid' => $data['cid']))));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作", 'url'=>__SELF__));
    		}
    	}else{
    		$cid = $this->_get('cid', 'intval');

    		/**
    		 * 所属分类 s start -------------------------------------------------->*/
    		$fid_menu = M('menu')->field('id,pid')->where('id='.$cid)->find();
    		if(empty($fid_menu['pid'])){									
    			$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$cid." and content_model <>''")->select();
    		}else{
    			$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$fid_menu['pid']." and content_model <>''")->select();
    		}
    		/**
    		 * 所属分类 s end -------------------------------------------------->*/
			
    		//默认字段状态
    		$str = "1|1|1|1|1|1|1|1|1";
			$is_cid_list = M('menu')->where("show_default_fields<>'' and id=".$cid)->find();
			if($is_cid_list) { $is_cid_list_str = $is_cid_list['show_default_fields']; }
			$show_default_fields_status = explode('|', $is_cid_list_str);
			$this->assign('show_default_fields_status', $show_default_fields_status);
    		
			//栏目扩展的字段  - select
    		$this->menu_extend_show_list = M('product_extend_show')->join(C('DB_PREFIX').'product_extend_fields on '.C('DB_PREFIX').'product_extend_show.field_id='.C('DB_PREFIX').'product_extend_fields.field_id')->where(C('DB_PREFIX').'product_extend_show.is_show=1 and '.C('DB_PREFIX').'product_extend_show.cid='.$cid)->field(C('DB_PREFIX').'product_extend_fields.*')->order(C('DB_PREFIX').'product_extend_fields.sort')->select();
    		
    		$this->assign('cid', $cid);
    		$this->display();
    	}
    }   
     

	/**
	 +---------------------------------
	 * 编辑产品 -- View
	 +---------------------------------*/
	public function product_edit(){
		if(IS_POST){
			$db = M('product');
			$cid = $this->_post('cid', 'intval');
			$aid = $this->_post('aid', 'intval');
			$data = $_POST['info'];
			$data['title'] = strip_tags($data['title']);
			$data['published'] = time();
			if(empty($data['title'])){
				echo json_encode(array('status' => 0, 'info' => "请输入标题！", 'url'=>__SELF__));
				exit;
			}
			if (empty($data['summary'])) {
				$data['summary'] = cutStr(strip_tags($data['content']), 200);
			}
			if (!empty($data['content'])) { //反转义
				$data['content'] = stripslashes($data['content']);
			}
			//扩展字段数据处理
			$menu_extend_show_list = M('product_extend_show')->join(C('DB_PREFIX').'product_extend_fields on '.C('DB_PREFIX').'product_extend_show.field_id='.C('DB_PREFIX').'product_extend_fields.field_id')->where(C('DB_PREFIX').'product_extend_show.is_show=1 and '.C('DB_PREFIX').'product_extend_show.cid='.$cid)->field(C('DB_PREFIX').'product_extend_fields.*')->order(C('DB_PREFIX').'product_extend_fields.sort')->select();
			foreach($menu_extend_show_list as $k=>$v){
				if(isset($_POST[$v['field_name']])){
					if(is_array($_POST[$v['field_name']])){
						$data[$v['field_name']] = trim(join(',',$_POST[$v['field_name']]));
					}else {
						$data[$v['field_name']] = trim($_POST[$v['field_name']]);
					}
				}
			}
			
			if ($db->where('id='.$aid)->save($data)) {
				echo json_encode(array('status' => 1, 'info' => "更新成功", 'url' => U('Product/product_list', array('cid' => $cid))));
			} else {
				echo json_encode(array('status' => 0, 'info' => "更新失败，请重试..."));
			}
			
		}else{
			$cid = $this->_get('cid', 'intval');
			$aid = $this->_get('aid', 'intval');
			
			//读取产品数据
			$this->product_info = M('product')->where('id ='.$aid)->find();
			
			/**
			 * 所属分类 s start -------------------------------------------------->*/
			$fid_menu = M('menu')->field('id,pid')->where('id='.$cid)->find();
			if(empty($fid_menu['pid'])){
				$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$cid." and content_model <>''")->select();
			}else{
				$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$fid_menu['pid']." and content_model <>''")->select();
			}
			/**
			 * 所属分类 s end -------------------------------------------------->*/
				
			//默认字段状态
			$str = "1|1|1|1|1|1|1|1|1";
			$is_cid_list = M('menu')->where("show_default_fields<>'' and id=".$cid)->find();
			if($is_cid_list) { $is_cid_list_str = $is_cid_list['show_default_fields']; }
			$show_default_fields_status = explode('|', $is_cid_list_str);
			$this->assign('show_default_fields_status', $show_default_fields_status);
			
			//栏目扩展的字段  - select
			$this->menu_extend_show_list = M('product_extend_show')->join(C('DB_PREFIX').'product_extend_fields on '.C('DB_PREFIX').'product_extend_show.field_id='.C('DB_PREFIX').'product_extend_fields.field_id')->where(C('DB_PREFIX').'product_extend_show.is_show=1 and '.C('DB_PREFIX').'product_extend_show.cid='.$cid)->field(C('DB_PREFIX').'product_extend_fields.*')->order(C('DB_PREFIX').'product_extend_fields.sort')->select();

			$this->assign('cid', $cid);
			$this->assign('aid', $aid);
			$this->display('product_add');
		}
	}
	
	/**
	 +---------------------------------
	 * 复制产品 -- Views
	 +---------------------------------*/
	public function product_copy(){
		if(IS_POST){
		$db = M('product');
    		$cid = $this->_post('cid', 'intval');
    		$data = $_POST['info'];
    		$data['title'] = strip_tags($data['title']);
    		$data['published'] = time();
    		if(empty($data['title'])){
    			echo json_encode(array('status' => 0, 'info' => "请输入标题！", 'url'=>__SELF__));
    			exit;
    		}
    		if (empty($data['summary'])) {
    			$data['summary'] = cutStr(strip_tags($data['content']), 200);
    		}
    		if (!empty($data['content'])) { //反转义
    			$data['content'] = stripslashes($data['content']);
    		}
    		//扩展字段数据处理
    		$menu_extend_show_list = M('product_extend_show')->join(C('DB_PREFIX').'product_extend_fields on '.C('DB_PREFIX').'product_extend_show.field_id='.C('DB_PREFIX').'product_extend_fields.field_id')->where(C('DB_PREFIX').'product_extend_show.is_show=1 and '.C('DB_PREFIX').'product_extend_show.cid='.$cid)->field(C('DB_PREFIX').'product_extend_fields.*')->order(C('DB_PREFIX').'product_extend_fields.sort')->select();
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
    			echo json_encode(array('status' => 1, 'info' => "已经发布", 'url' => U('Product/product_list', array('cid' => $data['cid']))));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "发布失败，请刷新页面尝试操作", 'url'=>__SELF__));
    		}
				
		}else{
			$cid = $this->_get('cid', 'intval');
			$aid = $this->_get('aid', 'intval');
				
			//读取产品数据
			$this->product_info = M('product')->where('id ='.$aid)->find();
				
			/**
			 * 所属分类 s start -------------------------------------------------->*/
			$fid_menu = M('menu')->field('id,pid')->where('id='.$cid)->find();
			if(empty($fid_menu['pid'])){
				$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$cid." and content_model <>''")->select();
			}else{
				$this->menu_list = M('menu')->field('id,menu_name')->where("pid=".$fid_menu['pid']." and content_model <>''")->select();
			}
			/**
			 * 所属分类 s end -------------------------------------------------->*/
	
			//默认字段状态
			$str = "1|1|1|1|1|1|1|1|1";
			$is_cid_list = M('menu')->where("show_default_fields<>'' and id=".$cid)->find();
			if($is_cid_list) { $is_cid_list_str = $is_cid_list['show_default_fields']; }
			$show_default_fields_status = explode('|', $is_cid_list_str);
			$this->assign('show_default_fields_status', $show_default_fields_status);
				
			//栏目扩展的字段  - select
			$this->menu_extend_show_list = M('product_extend_show')->join(C('DB_PREFIX').'product_extend_fields on '.C('DB_PREFIX').'product_extend_show.field_id='.C('DB_PREFIX').'product_extend_fields.field_id')->where(C('DB_PREFIX').'product_extend_show.is_show=1 and '.C('DB_PREFIX').'product_extend_show.cid='.$cid)->field(C('DB_PREFIX').'product_extend_fields.*')->order(C('DB_PREFIX').'product_extend_fields.sort')->select();
	
			$this->assign('cid', $cid);
			$this->assign('aid', $aid);
			$this->display('product_add');
		}
	}
		

	/**
	 +---------------------------------
	 * 删除产品  -- View
	 +---------------------------------*/
	public function del(){
		$id = $this->_get('id', 'intval');
		if(!empty($id)){
			$last_rs =  M('product')->where('id='.$id)->delete();
			if (!empty($last_rs)) {
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
	 * 站点配置
	 +---------------------------------*/
	public function changeAttr(){
		$id = $this->_get('id');
		$db = M("product");
		$where['id'] = $id;
		$is_m = $db->where($where)->getField('is_m');
		$data['is_m']=abs($is_m-1);
		if($db->where($where)->save($data)){
			echo json_encode(array("status" => 1, "info" => "<img src=".__ROOT__."/public/style/admin/img/iphone-".$data['is_m'].".png  border='0'>"));
			exit;
		}
		return false;
	}

	/**
	 +---------------------------------
	 * 站点配置
	 +---------------------------------*/
	public function changeStatus(){
		$id = $this->_get('id');
		$db = M("product");
		$where['id'] = $id;
		$status= $db->where($where)->getField('status');
		$data['status'] = abs($status-1);
		$statusArr = array("待审核", "已发布");
		if($db->where($where)->save($data)){
			echo json_encode(array("status" => 1, "info" => $statusArr[$data['status']]));
			exit;
		}
		return false;
	}
}