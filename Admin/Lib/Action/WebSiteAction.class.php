<?php

/**
 * 网站功能管理  -- Controller
 *********************************/
class WebSiteAction extends CommonAction {
			
	 /**
	  +---------------------------------
	  * 轮播管理
	  +---------------------------------*/ 
    public function banner_list(){
    	if(IS_POST){
    		$sort = $this->_post('sort', 'intval');
    		$db = M("banner"); // 实例化category对象
    		 
    		foreach($sort as $k=>$v){
    			// 要修改的数据对象属性赋值
    			$data['sort'] = $v;
    			$do_rs[] = $db->where('id='.$k)->save($data); //根据条件保存修改的数据
    		}
    	
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U('WebSite/banner_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U('WebSite/banner_list')));
    		}
    	}else{
    		$db = D('BannerView');
    		import('ORG.Util.Page');
    		$count = $db->count();
    		$Page  = new Page($count, 10);
    		$show  = $Page->show();
    		$list = $db->order('sort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$this->assign('ad_list',$list);
    		$this->assign('page',$show);
    		$this->display();
    	}
    }
    

	/**
	 +---------------------------------
	 * 添加轮播
	 +---------------------------------*/
    public function banner_add(){
    	if(IS_POST){
    		$db = M('banner');
    		$data = $_POST['info'];
    		$data['publish_time'] = time();
    		if ($db->add($data)) {
    			echo json_encode(array('status' => 1, 'info' => "添加成功", 'url' => U('WebSite/banner_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "添加失败", 'url'=>__SELF__));
    		}
    	}else{
    		$db = M('banner_menu');
    		$menu = $db->order('sort')->select();
    		//引入分类类
    		import('Class.Category', APP_PATH);
    		$menu_list = Category::merge_one_array($menu);
    		
    		$this->assign('menu_list', $menu_list);
    		$this->display();
    	}
    }


	/**
	 +---------------------------------
	 * 编辑轮播
	 +---------------------------------*/
    public function banner_edit(){
    	if(IS_POST){
    		$id = $this->_post('id', 'intval');
    		$db = M('banner');
    		$data = $_POST['info'];
    		$data['publish_time'] = time();
    		if ($db->where('id='.$id)->save($data)) {
    			echo json_encode(array('status' => 1, 'info' => "更新成功", 'url' => U('WebSite/banner_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "更新失败", 'url'=>__SELF__));
    		}
    	}else{

    		$db = M('banner_menu');
    		$menu = $db->order('sort')->select();
    		//引入分类类
    		import('Class.Category', APP_PATH);
    		$menu_list = Category::merge_one_array($menu);
    		
    		$id = $this->_get('id', 'intval');
    		$this->info = M('banner')->where('id='.$id)->find();
    		$this->assign('id', $id);
    		$this->assign('menu_list', $menu_list);
    		$this->display('banner_add');
    	}
    }   
    
    
	/**
	 +---------------------------------
	 * 轮播分类
	 +---------------------------------*/
    public function banner_menu(){
    	if(IS_POST){
    		/*  增加栏目 start  */
    		$add_menu_name = $this->_post('addname', 'htmlspecialchars');
    		$add_category_sort = $this->_post('addsort', 'intval');
    		$add_category_pid = $this->_post('pid', 'intval');
    
    		if(isset($add_menu_name)){
    				
    			$len = count($add_menu_name);
    			$category = M("banner_menu"); // 实例化category对象
    			for($i = 0 ;$i < $len;$i++){
    				$data['menu_name'] = "$add_menu_name[$i]";
    				$data['pid'] = $add_category_pid[$i];
    				$data['sort'] = $add_category_sort[$i];
    				$do_rs[] = $category->add($data);
    			}
    				
    		}
    		/*  增加栏目 end  */
    
    		/*  修改栏目 start  */
    		$update_menu_name = $this->_post('name', 'htmlspecialchars');
    		$update_category_sort = $this->_post('sort', 'intval');
    
    		if(isset($update_menu_name)){
    				
    			$category = M("banner_menu"); // 实例化menu对象
    				
    			foreach($update_menu_name as $k=>$v){
    				// 要修改的数据对象属性赋值
    				$update_one['menu_name'] = $v;
    				$do_rs[] = $category->where('id='.$k)->save($update_one); //根据条件保存修改的数据
    
    			}
    
    			foreach($update_category_sort as $k=>$v){
    				// 要修改的数据对象属性赋值
    				$update_two['sort'] = $v;
    				$do_rs[] = $category->where('id='.$k)->save($update_two); //根据条件保存修改的数据
    			}
    				
    		}
    		/*  修改栏目 end  */
    
    
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '栏目列表' . '更新成功', 'url' => U("Jkd/WebSite/banner_menu")));
    		} else {
    			echo json_encode(array('status' => 1, 'info' => '栏目列表' . '更新失败', 'url' => U("Jkd/WebSite/banner_menu")));
    		}
    	}else{
    		$db = M('banner_menu');
    		$menu = $db->order('sort')->select();
    		//引入分类类
    		import('Class.Category', APP_PATH);
    		$menu_list = Category::merge_many_array($menu);
    
    		$this->assign('menu_list', $menu_list);
    		$this->display();
    	}
    }
    
	/**
	 +---------------------------------
	 * 删除栏目 
	 +---------------------------------*/
    public function del(){
    	$del = $this->_get('id', 'intval');
    	if(!empty($del)){
    		/* 删除栏目 start */
    		if(M('banner_menu')->where('pid='.$del)->select())
    		{
    			echo json_encode(array('status' => 0, 'info' => '请先删除子栏目!'));
    			exit;
    		}
    
    		$do_del =  M('banner_menu')->where('id='.$del)->delete();
    		 
    		/*  处理结果  */
    		if (!empty($do_del)) {
    			echo json_encode(array('status' => 1, 'info' => '栏目列表' . '删除成功'));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '栏目列表' . '删除失败'));
    		}
    		/* 删除栏目 end */
    	}
    }
        
	/**
	 +---------------------------------
	 * 删除banner 
	 +---------------------------------*/
    public function banner_del(){
    	$id = $this->_get('id', 'intval');
    	if(!empty($id)){
    		$last_rs =  M('banner')->where('id='.$id)->delete();
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
	 * 广告管理
	 +---------------------------------*/ 
    public function ad_list(){
    	if(IS_POST){
    		$sort = $this->_post('sort', 'intval');
    		$db = M("ad"); // 实例化category对象
    		 
    		foreach($sort as $k=>$v){
    			// 要修改的数据对象属性赋值
    			$data['sort'] = $v;
    			$do_rs[] = $db->where('id='.$k)->save($data); //根据条件保存修改的数据
    		}
    		
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U('WebSite/ad_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U('WebSite/ad_list')));
    		}
    	}else{
    		$db = M('ad');
    		import('ORG.Util.Page');
    		$count = $db->count();
    		$Page  = new Page($count, 10);
    		$show  = $Page->show();
    		$list = $db->order('sort asc')->limit($Page->firstRow.','.$Page->listRows)->select();
    		$this->assign('ad_list',$list);
    		$this->assign('page',$show);
    		$this->display();
    	}
    }
    

	/**
	 +---------------------------------
	 * 添加广告
	 +---------------------------------*/
    public function ad_add(){
    	if(IS_POST){
    		$db = M('ad');
    		$data = $_POST['info'];
    		$data['publish_time'] = time();
    		if ($db->add($data)) {
    			echo json_encode(array('status' => 1, 'info' => "添加成功", 'url' => U('WebSite/ad_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "添加失败"));
    		}
    	}else{
    		$this->display();
    	}
    }


	/**
	 +---------------------------------
	 * 编辑广告
	 +---------------------------------*/
    public function ad_edit(){
    	if(IS_POST){
    		$id = $this->_post('id', 'intval');
    		$db = M('ad');
    		$data = $_POST['info'];
    		$data['publish_time'] = time();
    		if ($db->where('id='.$id)->save($data)) {
    			echo json_encode(array('status' => 1, 'info' => "更新成功", 'url' => U('WebSite/ad_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "更新失败", 'url'=>__SELF__));
    		}
    	}else{
    		$id = $this->_get('id', 'intval');
    		$this->ad_info = M('ad')->where('id='.$id)->find();
    		$this->assign('id', $id);
    		$this->display('ad_add');
    	}
    }	

	/**
	 +---------------------------------
	 * 删除广告
	 +---------------------------------*/
    public function ad_del(){
    	$id = $this->_get('id', 'intval');
    	if(!empty($id)){
    		$last_rs =  M('ad')->where('id='.$id)->delete();
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
	 * 标签管理
	 +---------------------------------*/
    public function tag_list(){
    	$this->tag_list = M('tag')->order('id desc')->select();
    	$this->display();
    } 

	/**
	 +---------------------------------
	 * 添加标签
	 +---------------------------------*/
    public function tag_add(){
    	if(IS_POST){
    		$db = M('tag');
    		$data = $_POST['info'];
    		if ($db->add($data)) {
    			echo json_encode(array('status' => 1, 'info' => "添加成功", 'url' => U('WebSite/tag_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "添加失败", 'url'=>__SELF__));
    		}
    	}else{
    		$this->display();
    	}
    }
    
	/**
	 +---------------------------------
	 * 编辑标签s
	 +---------------------------------*/
    public function tag_edit(){
  	  if(IS_POST){
    		$id = $this->_post('id', 'intval');
    		$db = M('tag');
    		$data = $_POST['info'];
    		if ($db->where('id='.$id)->save($data)) {
    			echo json_encode(array('status' => 1, 'info' => "更新成功", 'url' => U('WebSite/tag_list')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => "更新失败", 'url'=>__SELF__));
    		}
    	}else{
    		$id = $this->_get('id', 'intval');
    		$this->tag_info = M('tag')->where('id='.$id)->find();
    		$this->assign('id', $id);
    		$this->display('tag_add');
    	}
    }
    
	/**
	 +---------------------------------
	 * 删除标签
	 +---------------------------------*/
    public function tag_del(){
    	$id = $this->_get('id', 'intval');
    	if(!empty($id)){
    		$last_rs =  M('tag')->where('id='.$id)->delete();
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
	 * 文件管理
	 +---------------------------------*/
    public function file_manage(){
    	$this->display();
    }    
    
    
	/**
	 +---------------------------------
	 * 友情链接ss
	 +---------------------------------*/
    public function friend_link(){
    	if(IS_POST){
    		/* 删除友情链接 start */
    		$del = $this->_post('delete', 'intval');
    		if(!empty($del)){
    			$db = M('friendlink');
    			//循环删除
    			foreach ($del as $del_id){
    				$do_del[] = $db->where('id='.$del_id)->delete();
    			}
    		}
    		/* 删除友情链接 end */
    		
    		/*  增加友情链接  start  */
    		$add_name = $this->_post('add_name', 'htmlspecialchars');//站点名称
    		if(isset($add_name)){
    			$add_sort = $this->_post('add_sort', 'intval');//显示顺序
    			$add_url = $this->_post('add_url', 'htmlspecialchars');//站点URL
    			$add_description = $this->_post('add_description', 'htmlspecialchars');//描述
    			$add_logo = $this->_post('add_logo', 'htmlspecialchars');//LOGO
    			$len = count($add_name);
    			$friendlink = M("friendlink"); // 实例化category对象
    			for($i = 0 ;$i < $len;$i++){
    				$data['sort'] = $add_sort[$i];
    				$data['name'] = $add_name[$i];
    				$data['url'] = $add_url[$i];
    				$data['logo'] = $add_logo[$i];
    				$do_rs[] = $friendlink->add($data);
    			}
    		}
    		/*  增加友情链接  end  */
    		 	
    		
    		/*  修改友情链接 start  */
    		$update_sort = $this->_post('sort', 'intval');//显示顺序
    		$update_name = $this->_post('name', 'htmlspecialchars'); //站点名称
    		$update_url = $this->_post('url', 'htmlspecialchars');//站点URL
    		$update_logo = $this->_post('logo', 'htmlspecialchars');//LOGO
    			
    		if(isset($update_name)){
    		
    			$friendlink = M("friendlink"); // 实例化category对象
    			foreach($update_sort as $k=>$v){
    				// 要修改的数据对象属性赋值 -- 排序
    				$update_one['sort'] = $v;
    				$do_rs[] = $friendlink->where('id='.$k)->save($update_one); //根据条件保存修改的数据
    					
    			}
    		
    			foreach($update_name as $k=>$v){
    				//要修改的数据对象属性赋值 -- 站点名称
    				$update_two['name'] = $v;
    				$do_rs[] = $friendlink->where('id='.$k)->save($update_two); //根据条件保存修改的数据
    			}
    				
    			foreach($update_url as $k=>$v){
    				// 要修改的数据对象属性赋值 -- 站点URL
    				$update_three['url'] = $v;
    				$do_rs[] = $friendlink->where('id='.$k)->save($update_three); //根据条件保存修改的数据
    			}
    			
    			foreach($update_logo as $k=>$v){
    				// 要修改的数据对象属性赋值 -- 站点描述
    				$update_four['logo'] = $v;
    				$do_rs[] = $friendlink->where('id='.$k)->save($update_four); //根据条件保存修改的数据
    			}
    		
    		}
    		/*  修改友情链接  end  */
    		
    		
    		/*  处理结果  */
    		if (!empty($do_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U('WebSite/friend_link')));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U('WebSite/friend_link')));
    		}
    	}else {
    		$db = M('friendlink');
    		$this->friednslink_list = $db->order('sort asc')->select();
    		$this->display();
    	}
    }

	/**
	 +---------------------------------
	 * 留言管理
	 +---------------------------------*/
    public function message(){
    	//栏目扩展的字段  - select
    	$this->message_show_list = M('message_extend_fields')->where('is_show = 1')->select();
    	$db = M('message');
    	import('ORG.Util.Page');
    	$count = $db->count();
    	$Page  = new Page($count, 10);
    	$show  = $Page->show();
    	$list = $db->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('message_list',$list);
    	$this->assign('page',$show);
    	$this->display('message_list');
    }
    
    public function message_del(){
    $id = $this->_get('id', 'intval');
    	if(!empty($id)){
    		$last_rs =  M('message')->where('id='.$id)->delete();
    		if (!empty($last_rs)) {
    			echo json_encode(array('status' => 1, 'info' => '删除成功'));
    		} else {
    			echo json_encode(array('status' => 0, 'info' => '删除失败'));
    		}
    	}else{
    		echo json_encode(array('status' => 0, 'info' => '非法操作、' . '删除失败'));
    	}
    }
}