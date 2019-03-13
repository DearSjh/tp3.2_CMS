<?php
/**
 * 栏目管理  -- Controller
 *********************************/
class MenuAction extends CommonAction {

	/**
	 +---------------------------------
	 * 栏目列表  -- View
	 +---------------------------------*/
    public function menu_list(){
    	if(IS_POST){
    			/*  增加栏目 start  */
    			$add_menu_name = $this->_post('addname', 'htmlspecialchars');
    			$add_category_sort = $this->_post('addsort', 'intval');
    			$add_category_pid = $this->_post('pid', 'intval');
    		
    			if(isset($add_menu_name)){
    				 
    				$len = count($add_menu_name);
    				$category = M("menu"); // 实例化category对象
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
    				 
    				$category = M("menu"); // 实例化menu对象
    					
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
    				echo json_encode(array('status' => 1, 'info' => '栏目列表' . '更新成功', 'url' => U("Jkd/Menu/menu_list")));
    			} else {
    				echo json_encode(array('status' => 1, 'info' => '栏目列表' . '更新失败', 'url' => U("Jkd/Menu/menu_list")));
    			}
    	}else{
    		$db = M('menu');
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
    		if(M('menu')->where('pid='.$del)->select())
    		{
    			echo json_encode(array('status' => 0, 'info' => '请先删除子栏目!'));
    			exit;
    		}
    		
    		/***
    		 *  删除分类 （请先清空栏目下文章!）
    		 */
			
    		if(M('article')->where('cid='.$del)->select())
    		{
    			echo json_encode(array('status' => 0, 'info' => '请先清空该栏目下所有数据!'));
    			exit;
    		}
    		
    		if(M('product')->where('cid='.$del)->select())
    		{
    			echo json_encode(array('status' => 0, 'info' => '请先清空该栏目下所有数据!'));
    			exit;
    		}
    		
    		$do_del =  M('menu')->where('id='.$del)->delete();
    		
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
	 * 编辑栏目  -- View
	 +---------------------------------*/
	public function menu_edit(){
		if(IS_POST){
			$id = $this->_post('id', 'intval');
			$target = $this->_post('target', 'intval');
			$lang = $this->_post('lang', 'htmlspecialchars');
			$content_model = $this->_post('content_model', 'htmlspecialchars');
			$title = $this->_post('title', 'htmlspecialchars');
			$keywords = $this->_post('keywords', 'htmlspecialchars');
			$is_show = $this->_post('is_show', 'htmlspecialchars');
			$description = $this->_post('description', 'htmlspecialchars');
			if($content_model == 'article' || $content_model == 'product'){
				$show_default_fields = "1|1|1|1|1|1|1|1|1";
			}else if($content_model == 'page'){
				$show_default_fields = "1|1|1|1|1|1";
			}else{
				$show_default_fields = '';
			}
			$data = array(
				'target' => $target,	
				'lang' => $lang,	
				'content_model' => $content_model,	
				'show_default_fields' => $show_default_fields,	
				'title' => $title,	
				'keywords' => $keywords,	
				'is_show' => $is_show,	
				'description' => $description	
			);
			if(M('menu')->where('id='.$id)->save($data)){
    			echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U("Jkd/Menu/menu_list")));
			}else{
    			echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U("Jkd/Menu/menu_list")));
			}
			
		}else{
    		$id = $this->_get('id', 'intval');
    		$this->menu_info = M('menu')->where('id='.$id)->find();
    		$this->assign('id', $id);
			$this->display();
		}
	}
	
	/**
	 +---------------------------------
	 * 字段管理
	 +---------------------------------*/
	public function menu_fields_manage(){
		if(IS_POST){
			//保存默认字段
			$cid = $this->_post('cid', 'intval');
			if(empty($cid)){				
				echo json_encode(array('status' => 0, 'info' => '非法操作，请重试...'));
				exit();
			}
			
			$menu_info = M('menu')->where('id='.$cid)->find();
			if($menu_info['content_model'] == 'article' || $menu_info['content_model'] == 'product'){
				$str = join('|',array_slice($_POST, 0, 10));
			}else if($menu_info['content_model'] == 'page'){
				$str = join('|',array_slice($_POST, 0, 6));
			}
			
			$data = array();
			$data['show_default_fields'] = $str;
			$do_rs[] = M('menu')->where('id='.$cid)->save($data);

			$temp = M('menu')->where('id='.$cid)->find();
			//当前菜单所对应的内容模型
			$curr_content_model_name = $temp['content_model'];
			//保存修改扩展字段显示状态
			$article_extend_fields_list = M($curr_content_model_name.'_extend_fields')->where('is_show = 1')->order('sort asc')->select();
			foreach($article_extend_fields_list as $k=>$v){
				$extend_fields_rs = M($curr_content_model_name.'_extend_show')->where('cid='.$cid.' and field_id='.$v['field_id'])->find();
				if($extend_fields_rs){
					M($curr_content_model_name.'_extend_show')->where('cid='.$cid.' and field_id='.$v['field_id'])->setField('is_show',intval($_POST['field_'.$v['field_id']]));
				}else{
					$arr['cid'] = $cid;
					$arr['field_id'] = $v['field_id'];
					$arr['is_show'] = intval($_POST['field_'.$v['field_id']]) ;
					$arr['sort'] = $v['sort'];
					$do_rs[] = M($curr_content_model_name.'_extend_show')->add($arr);
				}
			}
				
			if(!empty($do_rs)){
				echo json_encode(array('status' => 1, 'info' => '更新成功', 'url' => U("Jkd/Menu/menu_list")));
			}else{
				echo json_encode(array('status' => 0, 'info' => '更新失败', 'url' => U("Jkd/Menu/menu_list")));
			}
		}else{
			$cid = $this->_get('id', 'intval');
			$menu_info = M('menu')->where('id='.$cid)->find();
			if(empty($cid)){	
				echo json_encode(array('status' => 0, 'info' => '非法操作，请重试...'));
				exit();
			}
			

			if($menu_info['content_model'] == 'article' || $menu_info['content_model'] == 'product'){				
				//字段默认显示
				$arr = array(
					array('txt'=>'语言选择','show'=>1),
					array('txt'=>'文章标题','show'=>1),
					array('txt'=>'文章发布状态','show'=>1),
					array('txt'=>'文章所属分类','show'=>1),
					array('txt'=>'文章图片','show'=>1),
					array('txt'=>'文章关键词','show'=>1),
					array('txt'=>'文章描述','show'=>1),
					array('txt'=>'文章摘要','show'=>1),
					array('txt'=>'点击量','show'=>1),
					array('txt'=>'文章内容','show'=>1)
				);
			}else if($menu_info['content_model'] == 'page'){
				//字段默认显示
				$arr = array(
					array('txt'=>'语言选择','show'=>1),
					array('txt'=>'文章标题','show'=>1),
					array('txt'=>'文章关键词','show'=>1),
					array('txt'=>'文章描述','show'=>1),
					array('txt'=>'点击量','show'=>1),
					array('txt'=>'文章内容','show'=>1)
				);
			}else{
				echo json_encode(array('status' => 0, 'info' => '非法操作，请重试...'));
				exit();
			}
			
			if($menu_info){
				$myarr = explode('|',$menu_info['show_default_fields']);
				if(count($myarr) > 5){
					for($i=0;$i<count($myarr);$i++){
						$arr[$i]['show'] = $myarr[$i];
					}
				}
			}
			$this->assign('cid', $cid);
			$this->assign('default_fields_list',$arr);

			//当前菜单所对应的内容模型
			$curr_content_model_name = $menu_info['content_model']; 
			//加载扩展字段不想用JOIN个人认为效率不高
			$extend_fields_list = M($curr_content_model_name.'_extend_fields')->where('is_show = 1')->order('sort asc')->select();
			foreach($extend_fields_list as $k=>$v){
				$is_show = M($curr_content_model_name.'_extend_show')->where('cid='.$cid.' and field_id='.$v['field_id'])->getField('is_show') == 1?1:0;
				$extend_fields_list[$k]['is_show'] = $is_show;
			}

			$this->assign('extend_fields_list', $extend_fields_list);
			$this->display();
		}
	}
}